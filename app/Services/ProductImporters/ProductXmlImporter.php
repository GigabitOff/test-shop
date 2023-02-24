<?php

namespace App\Services\ProductImporters;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImport;
use App\Modules\Localization\LocalizationService;
use App\Services\UploadImagesService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductXmlImporter
{

    private array $messages = [];

    private array $options;
    private array $locales;

    public function __construct(ProductImport $model)
    {
        $this->locales = LocalizationService::getLocales();
        $this->options = $model->options ?? [];
        $this->source_url = $model->source_file;
        if (! Str::startsWith($model->source_file, 'http')) {
            $this->source_url = Storage::disk('public')->path($model->source_file);
        }
    }

    /**
     * Обновление категорий: добавление несуществующих, обновление родительских связей.
     */
    protected function uploadCategories(Collection $categories): Collection
    {
        $importIds = $categories->pluck('importId')->filter();
        $realCats = Category::query()
            ->whereIn('id_1c', $importIds)->select('id', 'id_1c')->toBase()->get();
        $locale = app()->getLocale();

        // Добавляем несуществующие категории.
        foreach ($categories as $category) {
            $real = $realCats->firstWhere('id_1c', $category->importId);
            if (!$real) {
                $real = Category::create([
                    'id_1c' => $category->importId,
                    'parent_id_1c' => $category->importParentId,
                    'slug' => createSlugAndCheckUnique($category->importName, Category::class),
                    "name:{$locale}" => $category->importName,
                ]);
            }
            $category->id = $real->id;
        }

        $realCats = Category::query()->whereIn('id_1c', $importIds)
            ->select('id', 'parent_id', 'id_1c', 'parent_id_1c')
            ->get();

        // Обновляем родительские связки
        foreach ($categories as $category) {
            $real = $realCats->firstWhere('id_1c', $category->importId);
            $realParent = $realCats->firstWhere('id_1c', $category->importParentId);
            if ($real) {
                $real->parent_id = (!empty($category->importParentId) && $realParent)
                    ? $realParent->id
                    : 0;

                if ($real->isDirty('parent_id')) {
                    $real->save();
                }
            }
        }

        return $categories;
    }

    public function importProductsXml(): bool
    {
        try {
            try {
                $xml = simplexml_load_file($this->source_url);
            } catch (\Exception $e) {
                try {
                    $arrContextOptions = array("ssl" => array("verify_peer" => false, "verify_peer_name" => false));
                    $assertion = file_get_contents($this->source_url, false, stream_context_create($arrContextOptions));
                    $xml = simplexml_load_string($assertion);
                } catch (\Exception $e) {
                    $this->messages[] = 'Error upload content from external link.';
                    return false;
                }
            }
            $importCats = collect($xml->xpath('//' . $this->options['category']))
                ->map(function ($cat) {
                    $attributes = $cat->attributes();
                    $id = (string)$attributes->{$this->options['category_id_attribute']};
                    $parentId = (string)$attributes->{$this->options['category_parent_id_attribute']};
                    return (object)[
                        'importId' => $id,
                        'importParentId' => $parentId,
                        'importName' => (string)$cat,
                    ];
                });

            $categories = $this->uploadCategories($importCats);

            $currencies = array();
            try {
                foreach ($xml->xpath('//currency') as $currency) {
                    $attributes = $currency->attributes();
                    $id = ((array)$attributes['id'])[0];
                    $currencies[$id] = (float)(((array)$attributes['rate'])[0]);
                }
            } catch (\Exception $e) {
            }

            foreach ($xml->xpath('//' . $this->options['product']) as $prod) {
                DB::beginTransaction();
                try {
                    $prodArr = (array)$prod;

                    $product_article = $this->takeTagValue($prodArr, 'article');
                    $product_warranty = $this->takeTagValue($prodArr, 'warranty');
                    $product_country_origin = $this->takeTagValue($prodArr, 'country_origin');
                    $product_country_brand = $this->takeTagValue($prodArr, 'country_brand');

                    $params = $prod->xpath($this->options['param']) ?: [];
                    foreach ($params as $p) {
                        $attributes = $p->attributes();
                        $key = ((array)$attributes[$this->options['param_key_attribute']])[0];

                        if (!$product_article && ($key == $this->options['article'] || mb_strtolower(
                                    $key,
                                    'UTF-8'
                                ) == 'артикул')) {
                            $product_article = isset(((array)$p)[0]) ? (string)((array)$p)[0] : (string)$p;
                        }
                        if (!$product_warranty
                            && ($key == $this->options['warranty']
                                || mb_strtolower($key, 'UTF-8') == 'гарантия'
                                || mb_strtolower($key, 'UTF-8') == 'гарантия, мес')) {
                            $product_warranty = isset(((array)$p)[0]) ? (string)((array)$p)[0] : (string)$p;
                            if (mb_strtolower($key, 'UTF-8') == 'гарантия, мес') {
                                $product_warranty .= 'мес.';
                            }
                        }
                        if (!$product_country_origin
                            && ($key == $this->options['country_origin']
                                || mb_strtolower($key, 'UTF-8') == 'страна-производитель'
                                || mb_strtolower($key, 'UTF-8') == 'страна производитель')
                        ) {
                            $product_country_origin = isset(((array)$p)[0]) ? (string)((array)$p)[0] : (string)$p;
                        }
                        if (!$product_country_brand && $key == $this->options['country_brand']) {
                            $product_country_brand = isset(((array)$p)[0]) ? (string)((array)$p)[0] : (string)$p;
                        }
                    }

                    $productIdAttribute = $this->options['product_id_attribute'] ?? '';
                    $import_id = $productIdAttribute ? (string)$prod->attributes()->{$productIdAttribute} : null;

                    // if there are no article use product id as article
                    $product_article = trim($product_article ?: $import_id);

                    if (empty($import_id) && empty($product_article)){
                        $this->messages[] = 'Product has empty id and articul';
                        continue;
                    }

                    /** @var Product|null $product */
                    $product = $import_id
                        ? Product::query()->where('id_1c', $import_id)->first()
                        : null;

                    if (!$product && $product_article){
                        $product = Product::query()->where('articul', $product_article)->first();
                    }

//                    $price_rate = (double)$this->options['price_rate'] > 0 ? (double)$this->options['price_rate'] : 1;
                    $price_rate = 1;
                    try {
                        $xml_price_rate = (double)$currencies[$prodArr['currencyId']];
                        if ($xml_price_rate > 0) {
                            $price_rate *= $xml_price_rate;
                        }
                    } catch (\Exception $e) {
                    }

                    if ($product) {

                        $this->updateTranslatableValue($product, 'name', $prodArr);
                        $this->updateTranslatableValue($product, 'description', $prodArr);
                        $this->updateTranslatableValue($product, 'seller', $prodArr);
                        $this->updateTranslatableValue($product, 'measure', $prodArr);


                        if ($this->options['reload_price']) {
                            $product->price_rrc = (double)($prodArr[$this->options['price_rrp']] ?? 0) * $price_rate;
                            $product->price_purchse = (double)($prodArr[$this->options['price_purchase']] ?? 0) * $price_rate;
                        }
                        if ($this->options['stock'] && array_key_exists($this->options['stock'], $prodArr)) {
                            $product->availability = $prodArr[$this->options['stock']]
                                ? Product::AVAILABILITY_IN_STOCK
                                : Product::AVAILABILITY_OUT_OF_STOCK;
                        } else {
                            $availability = $this->getXmlAttribute($prod, 'available');
                            $product->availability = is_null($availability)
                                ? Product::AVAILABILITY_ON_BACKORDER
                                : ($this->boolCast($availability)
                                    ? Product::AVAILABILITY_IN_STOCK
                                    : Product::AVAILABILITY_OUT_OF_STOCK);
                        }

                        if (($this->options['reload_warranty'] ?? false) && $product_warranty) {
                            $product->warranty = $product_warranty;
                        }

                        $product->imported = true;
                        $product->save();

                        if ($this->options['reload_category'] ?? false) {
                            $importCatId = (string)$product->{$this->options['product_category_id']};
                            if ($cat = $categories->firstWhere('import_id', $importCatId)) {
                                $product->categories()->sync($cat->id);
                            }
                        }

                        if (($this->options['reload_brand'] ?? false)
                            && $this->options['brand']
                            && array_key_exists($this->options['brand'], $prodArr)) {
                            $brandName = (string)$prod->{$this->options['brand']};
                            $brand = $brandName
                                ? Brand::query()->whereTranslationLike('name', $brandName)->value('id')
                                : null;

                            if ($brand) {
                                $product->brand()->associate($brand);
                                $product->save();
                            }
                        }

                        // reload all photos
                        if (($this->options['reload_photos'] ?? false)
                            && array_key_exists($this->options['photo'], $prodArr)) {
                            try {
                                $imageService = app()->make(UploadImagesService::class);
                                $urls = (array)$prodArr[$this->options['photo']];
                                $urls = array_slice($urls, 0, 10);
                                if (!empty($urls)) {
                                    $url = array_shift($urls);
                                    $imageService->uploadImages($product, [$url], true);
                                }
                                if (!empty($urls)) {
                                    $imageService->uploadImages($product, $urls, false);
                                }
                            } catch (\Exception $e) {
                            }
                        }

                        // reload_characteristics
                        if ($this->options['reload_characteristics'] ?? false) {
                            $product->attributeValues()->delete();
                            foreach ($prod->xpath($this->options['param']) as $p) {
                                try {
                                    $attributes = $p->attributes();
                                    $key = ((array)$attributes[$this->options['param_key_attribute']])[0];
                                    if ($key != $this->options['article']
                                        && mb_strtolower($key, 'UTF-8') != 'артикул'
                                        && $key != $this->options['warranty']
                                        && mb_strtolower($key, 'UTF-8') != 'гарантия'
                                        && mb_strtolower($key, 'UTF-8') != 'гарантия, мес'
                                        && $key != $this->options['country_origin']
                                        && mb_strtolower($key, 'UTF-8') != 'страна-производитель'
                                        && mb_strtolower($key, 'UTF-8') != 'страна производитель'
                                        && $key != $this->options['country_brand']
                                    ) {
                                        $ch_value = isset(((array)$p)[0]) ? (string)((array)$p)[0] : (string)$p;
                                        $this->createProductCharacteristic($product, $key, $ch_value);
                                    }
                                } catch (\Exception $e) {
                                }
                            }
                        }
                        DB::commit();
                        continue;
                    }

                    $product = new Product;
                    $product->id_1c = $import_id;

                    $product->width = $this->takeTagValue($prodArr, 'width')
                        ?? $this->takeParamValue($params, 'width');
                    $product->height = $this->takeTagValue($prodArr, 'height')
                        ?? $this->takeParamValue($params, 'height');
                    $product->length = $this->takeTagValue($prodArr, 'length')
                        ?? $this->takeParamValue($params, 'length');
                    $product->weight = $this->takeTagValue($prodArr, 'weight')
                        ?? $this->takeParamValue($params, 'weight');
                    $product->color = $this->takeTagValue($prodArr, 'color')
                        ?? $this->takeParamValue($params, 'color');

                    $product->price_rrc = (double)($prodArr[$this->options['price_rrp']] ?? 0) * $price_rate;
                    $product->price_purchse = (double)($prodArr[$this->options['price_purchase']] ?? 0) * $price_rate;

                    if ($this->options['stock'] && array_key_exists($this->options['stock'], $prodArr)) {
                        $product->availability = $prodArr[$this->options['stock']]
                            ? Product::AVAILABILITY_IN_STOCK
                            : Product::AVAILABILITY_OUT_OF_STOCK;
                    } else {
                        $availability = $this->getXmlAttribute($prod, 'available');
                        $product->availability = is_null($availability)
                            ? Product::AVAILABILITY_ON_BACKORDER
                            : ($this->boolCast($availability)
                                ? Product::AVAILABILITY_IN_STOCK
                                : Product::AVAILABILITY_OUT_OF_STOCK);
                    }

                    $this->updateTranslatableValue($product, 'name', $prodArr);
                    $this->updateTranslatableValue($product, 'description', $prodArr);
                    $this->updateTranslatableValue($product, 'measure', $prodArr);
                    $this->updateTranslatableValue($product, 'seller', $prodArr);

                    if ($product_warranty) {
                        $product->warranty = $product_warranty;
                    }

                    $product->articul = $product_article;
                    $product->slug = createSlugAndCheckUnique($product->name ?: Str::random(8), Product::class);

                    $product->imported = true;
                    $product->save();

                    $importCatId = (string)$product->{$this->options['product_category_id']};
                    if ($cat = $categories->firstWhere('import_id', $importCatId)) {
                        $product->categories()->sync($cat->id);
                    }

                    if ($this->options['brand'] && array_key_exists($this->options['brand'], $prodArr)) {
                        $brandName = (string)$prod->{$this->options['brand']};
                        $brand = $brandName
                            ? Brand::query()->whereTranslationLike('name', $brandName)->value('id')
                            : null;

                        if ($brand) {
                            $product->brand()->associate($brand);
                            $product->save();
                        }
                    }


                    foreach ($prod->xpath($this->options['param']) as $p) {
                        try {
                            $attributes = $p->attributes();
                            $key = ((array)$attributes[$this->options['param_key_attribute']])[0];
                            if ($key != $this->options['article'] && mb_strtolower($key, 'UTF-8') != 'артикул'
                                && $key != $this->options['warranty'] && mb_strtolower($key, 'UTF-8') != 'гарантия'
                                && mb_strtolower($key, 'UTF-8') != 'гарантия, мес'
                                && $key != $this->options['country_origin']
                                && mb_strtolower($key, 'UTF-8') != 'страна-производитель'
                                && mb_strtolower($key, 'UTF-8') != 'страна производитель'
                                && $key != $this->options['country_brand']
                            ) {
                                $ch_value = isset(((array)$p)[0]) ? (string)((array)$p)[0] : (string)$p;
                                $this->createProductCharacteristic($product, $key, $ch_value);
                            }
                        } catch (\Exception $e) {
                            //logger($e->getMessage());
                        }
                    }

                    if (array_key_exists($this->options['photo'], $prodArr)) {
                        try {
                            $imageService = app()->make(UploadImagesService::class);
                            $urls = (array)$prodArr[$this->options['photo']];
                            $urls = array_slice($urls, 0, 10);
                            if (!empty($urls)) {
                                $url = array_shift($urls);
                                $imageService->uploadImages($product, [$url], true);
                            }
                            if (!empty($urls)) {
                                $imageService->uploadImages($product, $urls, false);
                            }
                        } catch (\Exception $e) {
                        }
                    }
                    DB::commit();
                } catch (\Exception $e) {
                    logger(__METHOD__ . $e->getMessage());
                    $this->messages[] = $e->getMessage();
                    DB::rollBack();
                }
            }
            $this->checkProductsAvailability($this->options['nullify_stock_if_not_found'] ?? false);
        } catch (\Exception $e) {
            logger(__METHOD__ . $e->getMessage());
            return false;
        }

        return true;
    }

    /**
     * Заполняет "свойство" товара проверяя наличие локализованных элементов.
     *
     * Для существующего товара проверяет флаги обновления "свойства"
     *
     * @param Product $product
     * @param string $attr
     * @param $source
     * @return void
     */
    private function updateTranslatableValue(Product $product, string $attr, $source)
    {
        $canUpdate = ($this->options['reload_all'] ?? false)
            || ($this->option["reload_$attr"] ?? false);

        if ($product->exists && !$canUpdate){
            return;
        }

        $product->{$attr} = $this->takeTagValue($source, $attr);

        foreach ($this->locales as $locale) {
            $key = $this->options[$attr] ?? '';
            if ($key && array_key_exists("{$key}_{$locale}", $source)) {
                $product->translate($locale)->{$attr} = (string)$source["{$key}_{$locale}"];
            }
        }
    }

    /**
     * Получает значение тега по его имени.
     *
     * @param array $source
     * @param string $key
     * @param $default
     * @return mixed|null
     */
    private function takeTagValue(array $source, string $key, $default = null)
    {
        return !empty($this->options[$key])
            && array_key_exists($this->options[$key], $source)
            ? $source[$this->options[$key]] : $default;
    }

    /**
     * Получает значение тега param по имени ключа.
     *
     * @param array $params
     * @param string $key
     * @param $default
     * @return string|null
     */
    private function takeParamValue(array $params, string $key, $default = null): ?string
    {
        $keyName = $this->options['param_key_attribute'];
        foreach ($params as $p) {
            $paramName = $p->attributes()->{$keyName};

            if ($paramName == $this->options[$key]) {
                $value = (string)$p;
                break;
            }
        }
        return $value ?? $default;
    }

    private function getXmlAttribute($xml, $key): ?string
    {
        foreach ($xml->attributes() as $a => $b) {
            if ($a === $key) {
                return (string)$b;
            }
        }

        return null;
    }

    private function boolCast(string $value): bool
    {
        return in_array($value, ['true', 'on', 'yes', '1']);
    }

    public function createProductCharacteristic($product, $key, $value)
    {
        $attribute = Attribute::whereTranslationLike('name', "$key")->first();

        $locale = app()->getLocale();
        if (!$attribute) {
            $attribute = Attribute::create([
                'name' => $key,
                'id_1c' => Str::uuid(),
                'slug' => createSlugAndCheckUnique($key, Attribute::class),
            ]);
        }

        if ($attribute && !empty($value)) {
            $term = new AttributeValue();

            $term->product()->associate($product);
            $term->attribute()->associate($attribute);
            $term->translateOrNew($locale)->name = $value;
            $term->translateOrNew($locale)->slug = Str::slug($value);

            $term->save();

            $catIds = $product->categories->pluck('id');
            $attribute->categories()->syncWithoutDetaching($catIds, ['main => false']);
        }
    }

    public function checkProductsAvailability($nullify_stock_if_not_found = false)
    {
        if ($nullify_stock_if_not_found) {
            Product::query()
                ->where('imported', 0)
                ->where('availability', '!=', Product::AVAILABILITY_ON_BACKORDER)
                ->update(['availability' => Product::AVAILABILITY_OUT_OF_STOCK]);
        }
        Product::query()->update(['imported' => 0]);
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

}
