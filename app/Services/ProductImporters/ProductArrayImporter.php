<?php

namespace App\Services\ProductImporters;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\ProductImport;
use App\Models\Market;
use App\Models\Product;
use App\Models\ProductCharacteristic;
use App\Models\ProductPhoto;
use App\Models\Category;
use App\Models\Seller;
use App\Modules\Localization\LocalizationService;
use App\Services\Imports\ErcImportService;
use App\Services\Imports\UgContractImportService;
use App\Services\UploadImagesService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Input;
use App\Models\ImportProducts;
use App\Jobs\ImportProducts as ImportProductsJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use const http\Client\Curl\Features\HTTP2;

class ProductArrayImporter
{

    private array $messages = [];

    private Product $product;
    private ProductImport $import;

    private array $options;
    private array $headers;
    private array $row;
    private bool $skipEmptyValues = false;


    public function __construct(ProductImport $model)
    {
        $this->import = $model;
        $this->options = $model->options ?? [];
        $this->source_url = $model->source_file;
        if (! Str::startsWith($model->source_file, 'http')) {
            $this->source_url = Storage::disk('public')->path($model->source_file);
        }

        $this->skipEmptyValues = $this->options['ignore_empty_values'] ?? false;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
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

    public function importProductsExcel(): bool
    {
        try {
            $url = $this->fixGoogleSheetUrl($this->source_url);
            $contents = file_get_contents($url);
            $extension = $this->getExcelExtension(substr($contents, 0, 100));
            $path = "tmp/temp.{$extension}";
            Storage::disk('local')->put($path, $contents);
            $data = Excel::toArray(null, Storage::disk('local')->path($path));
            return $this->importProductsFromArray($data[0]);
        } catch (\Exception $e) {
            $this->messages[] = $e->getMessage();
            return false;
        }
    }

    /**
     * Корректирует строку запроса когда указана google sheet ссылка.
     *
     * @param string $url
     * @return string
     */
    protected function fixGoogleSheetUrl(string $url): string
    {
        $pattern = '/(https:\/\/docs\.google\.com\/spreadsheets\/d\/[^\/]+?)\/(.*)/';
        if (preg_match($pattern, $url)){
            $url = preg_replace($pattern, '$1/export?format=xlsx', $url);
        }

        return $url;
    }

    /**
     * Определяет расширение Excel файла по сигнатуре данных
     *
     * @url https://rdrr.io/cran/readxl/src/R/excel-format.R
     *
     * @param $content
     * @return string
     * @throws \Exception
     */
    private function getExcelExtension($content): string
    {
        if ('504b0304' === bin2hex(substr($content, 0, 4))){
            return 'xlsx';
        } else if ('d0cf11e0a1b11ae1' === bin2hex(substr($content, 0, 8))){
            return 'xls';
        }

        throw(new \Exception('Wrong file format. Available only xls, xlsx'));
    }

    public function importProductsCsv(): bool
    {
        try {
            $rows = array();
            if (($handle = fopen($this->source_url, "r")) !== false) {
                while (($row = fgetcsv($handle, 100000, $this->options['main_delimiter'])) !== false) {
                    $rows[] = $row;
                }
            }
            return $this->importProductsFromArray(array_filter($rows));
        } catch (\Exception $e) {
            $this->messages[] = $e->getMessage();
            return false;
        }
    }

    public function importProductsFromArray($array): bool
    {
        try {
            $headers = $array[0];
            unset($array[0]);

            // Для варианта, когда названия атрибутов заданы в заголовках
//            $params = $headers;
//            $notParams = [
//                'ID',
//                'category',
//                'article',
//                'price',
//                'stock',
//                'brand',
//                'warranty',
//                'name',
//                'description',
//                'photo'
//            ];
//            foreach ($notParams as $notParam) {
//                if (array_search($this->options[$notParam], $params) >= 0) {
//                    unset($params[array_search($this->options[$notParam], $params)]);
//                }
//            }
//            foreach ($locales as $locale) {
//                $paramLocale = "name_{$locale}";
//                if (array_search($paramLocale, $params) >= 0) {
//                    unset($params[array_search($paramLocale, $params)]);
//                }
//                $paramLocale = "description_{$locale}";
//                if (array_search($paramLocale, $params) >= 0) {
//                    unset($params[array_search($paramLocale, $params)]);
//                }
//            }

            $this->headers = $headers;

            foreach ($array as $index => $item) {
                $rowNo = $index + 1; // указатель на строку
                if  (count($headers) !== count($item)){
                    $this->messages[] = "Error read row at no: {$rowNo}";
                    continue;
                }
                $this->row = $item;
                try {
                    DB::beginTransaction();
                    $id = trim($item[array_search($this->options['product_id'], $headers)]);
                    $sku = trim($item[array_search($this->options['article'], $headers)]);

                    /** @var Product $product */
                    if ($id) {
                        $product = Product::query()
                            ->where('id_1c', $id)->first();
                    }

                    if (empty($product) && $sku) {
                        $product = Product::query()
                            ->where('articul', $sku)->first();
                    }

                    if (empty($product)) {
                        $this->createProduct($sku, $id);
                    } else {
                        $this->updateProduct($product);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    logger(__METHOD__ . $e->getMessage());
                    $this->messages[] = "Error row at no: {$rowNo}; {$e->getMessage()}";
                    DB::rollBack();
                }
            }
            $this->checkProductsAvailability($this->import->getOptionValue('nullify_stock_if_not_found'));
        } catch (\Exception $e) {
            logger(__METHOD__ . $e->getMessage());
            return false;
        }

        return true;
    }

    private function updateProduct(Product $product)
    {
        $this->product = $product;
//        $price_rate = (double)($this->options['price_rate'] ?? 0) > 0
//            ? (double)$this->options['price_rate'] : 1;
        $price_rate = 1;

        if ($this->import->getOptionValue('reload_price')
            || $this->import->getOptionValue('reload_all')) {
            $this->updatePrice($price_rate);
        }

        if ($this->columnExists('stock')) {
            $this->updateAvailability();
        }

        $this->updateTranslatableValue('name');
        $this->updateTranslatableValue('name');
        $this->updateTranslatableValue('measure');

        $this->updateParamValue('warranty');
        $this->updateParamValue('width');
        $this->updateParamValue('length');
        $this->updateParamValue('height');
        $this->updateParamValue('weight');

        $product->imported = true;
        $product->save();

        if ($this->import->getOptionValue('reload_category')
            || $this->import->getOptionValue('reload_all')) {
            $this->updateCategory();
        }
        if ($this->import->getOptionValue('reload_brand')
            || $this->import->getOptionValue('reload_all')) {
            $this->updateBrand();
        }

        // reload all photos
        if ($this->import->getOptionValue('reload_photos')
            || $this->import->getOptionValue('reload_all')) {
            $this->updatePhoto();
        }
        // reload_characteristics
        if ($this->import->getOptionValue('reload_characteristics')
            || $this->import->getOptionValue('reload_all')) {
            $product->attributeValues()->delete();

            $this->updateCharacteristics();
        }
    }

    private function createProduct(string $sku, string $itemId)
    {
        $product = new Product;
        $this->product = $product;

//        $price_rate = (double)$this->import->getOptionValue('price_rate') > 0
//            ? (double)$this->import->getOptionValue('price_rate') : 1;
        $price_rate = 1;

        $product->articul = $sku;
        $product->id_1c = $itemId;

        $this->updatePrice($price_rate);

        if ($this->columnExists('stock')) {
            $this->updateAvailability();
        }

        $this->updateTranslatableValue('name');
        $this->updateTranslatableValue('description');
        $this->updateTranslatableValue('measure');
        $this->updateTranslatableValue('seller');
        $this->updateParamValue('warranty');
        $this->updateParamValue('width');
        $this->updateParamValue('length');
        $this->updateParamValue('height');
        $this->updateParamValue('weight');

        $product->slug = createSlugAndCheckUnique($product->name, Product::class);
        $product->imported = true;
        $product->save();

        $this->updateCharacteristics();
        $this->updateCategory();
        $this->updateBrand();
        $this->updatePhoto();

    }

    private function updatePrice($price_rate)
    {
        $param = $this->import->getOptionValue('price_rrp');
        $value = $this->getDataParam($param, 0);
        $price = (double)$value * $price_rate;
        if ($this->notSkipEmptyValue($value)) {
            $this->product->price_rrc = $price;
        }

        $param = $this->import->getOptionValue('price_purchase');
        $value = $this->getDataParam($param, 0);
        $price = (double)$value * $price_rate;
        if ($this->notSkipEmptyValue($value)) {
            $this->product->price_purchase = $price;
        }
    }

    private function updateAvailability()
    {
        $param = $this->import->getOptionValue('stock');
        $value = $this->getDataParam($param, 0);
        if ($this->notSkipEmptyValue($value)) {
            $this->product->availability = $value
                ? Product::AVAILABILITY_IN_STOCK
                : Product::AVAILABILITY_OUT_OF_STOCK;
        }
    }

    private function updateTranslatableValue(string $key)
    {
        $canUpdate = $this->import->getOptionValue('reload_all')
            || $this->import->getOptionValue("reload_{$key}");

        if ($this->product->exists && ! $canUpdate){
            return;
        }

        $param = $this->import->getOptionValue($key);
        if (empty($param)){
            return;
        }

        $value = $this->getDataParam($param, null);
        if (!is_null($value) && $this->notSkipEmptyValue($value)) {
            $this->product->{$key} = $value;
        }

        $locales = LocalizationService::getLocales();

        foreach ($locales as $locale) {
            $param = "{$key}_{$locale}";
            $value = $this->getDataParam($param, null);
            if (!is_null($value) && $this->notSkipEmptyValue($value) ) {
                $this->product->{"$key:$locale"} = $value;
            }
        }
    }

    private function updateParamValue(string $key)
    {
        $canUpdate = $this->import->getOptionValue('reload_all')
            || $this->import->getOptionValue("reload_{$key}");

        if ($this->product->exists && ! $canUpdate){
            return;
        }

        if ($this->columnNotExists($key)){
            return;
        }

        $param = $this->import->getOptionValue($key);

        $value = $this->getDataParam($param, null);
        if ($this->notSkipEmptyValue($value)) {
            $this->product->{$key} = $value;
        }
    }

//    private function updateWarranty()
//    {
//        if ($this->columnNotExists('warranty')){
//            return;
//        }
//
//        $param = $this->import->getOptionValue('warranty');
//
//        $value = $this->getDataParam($param, null);
//        if ($this->notSkipEmptyValue($value)) {
//            $this->product->warranty = $value;
//        }
//    }

    private function updateCategory()
    {
        if ($this->columnNotExists('category')){
            return;
        }

        $param = $this->import->getOptionValue('category');

        $value = $this->getDataParam($param, null);
        if ($this->notSkipEmptyValue($value)) {
            $cat = $value
                ? Category::query()->whereTranslationLike('name', "$value")->value('id')
                : null;

            $this->product->categories()->sync($cat->id);
        }
    }

    private function updateBrand()
    {
        if ($this->columnNotExists('brand')){
            return;
        }

        $param = $this->import->getOptionValue('brand');
        $value = $this->getDataParam($param);

        $brand = $value
            ? Brand::query()->whereTranslationLike('name', $value)->value('id')
            : null;

        if ($this->notSkipEmptyValue($brand)) {
            $this->product->brand()->associate($brand);
            $this->product->save();
        }
    }

    private function updatePhoto()
    {
        if ($this->columnNotExists('photo')){
            return;
        }

        $param = $this->import->getOptionValue('photo');

        $value = $this->getDataParam($param);
        if ($this->notSkipEmptyValue($value)) {
            $imageService = app()->make(UploadImagesService::class);

            $delimiter = $this->options['photos_delimiter'] ?? ',';
            $urls = explode($delimiter, $value);
            $urls = array_slice($urls, 0, 10);  // ограничиваем 10 фото
            if (!empty($urls)) {
                $url = array_shift($urls);
                $imageService->uploadImages($this->product, [$url], true);
            }
            if (!empty($urls)) {
                $imageService->uploadImages($this->product, $urls, false);
            }
        }
    }

    private function updateCharacteristics()
    {
        $attrPrefix = $this->import->getOptionValue('attribute_prefix');
        $attrValuePrefix = $this->import->getOptionValue('attribute_value_prefix');
        $attrHeaders = array_filter($this->headers, function($el) use ($attrPrefix){
            $el = str_replace($attrPrefix, '', $el);
            return preg_match('/^[\d]+$/', $el);
        });
        foreach ($attrHeaders as $header) {
            $attrName = $this->getDataParam($header);
            $header = str_replace($attrPrefix, $attrValuePrefix, $header);
            $attrValue = $this->getDataParam($header);
            if ($attrName && $attrValue) {
                $this->createProductCharacteristic($this->product, $attrName, $attrValue);
            }
        }
    }

    private function columnExists(string $key): bool
    {
        $option = $this->import->getOptionValue($key);
        return $option && (false !== array_search($option, $this->headers));
    }

    private function columnNotExists(string $key): bool
    {
        return ! $this->columnExists($key);
    }

    private function notSkipEmptyValue($value): bool
    {
        return !$this->skipEmptyValue($value);
    }

    private function skipEmptyValue($value): bool
    {
        return empty($value)
            && ($this->import->getOptionValue('ignore_empty_values'));
    }

    private function getDataParam(string $param, $default = '')
    {
        $index = array_search($param, $this->headers);
        return (false !== $index && isset($this->row[$index]))
            ? $this->row[$index]
            : $default;
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

}
