<?php

namespace App\Http\Livewire\Catalog\Product;

use App\Http\Livewire\Forms\Customer\QuickPurchase;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Traits\WithExpandProduct;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;

class ShowPurchaseSectionLivewire extends Component
{
    use WithExpandProduct;

    public Product $product;
    public array $selectorAttributes = [];
    public $quantity;
    public $price;

    public function mount()
    {
        $this->prepareAttributesVariations($this->product);
        $this->evaluateSelectorAttributes($this->product);
        $priceField = Product::getPriceFieldWithParams(null, $this->product->price_sale,  $this->product->price_wholesale, $this->product->price_sale_show);
        $this->price = $this->product->$priceField;
        $this->quantity = $this->product->multiplicity;
        session([
            'current_product_id' => $this->product->id,
            'current_product_quantity' => $this->quantity,
            'current_product_price' => $this->price,
            'quick_purchase_status' => QuickPurchase::STATUS_PURCHASE_FORM,
        ]);
    }

    public function render()
    {
        $this->expandProductAvailability($this->product);
        $this->expandProductUniqColorVariations($this->product);

        return view('livewire.catalog.product.show-purchase-section-livewire');
    }

    public function updatedQuantity($value)
    {
        $this->quantity = $value;
        session(['current_product_quantity' => $value]);
    }

    /**
     * Собираем массив значений для заполнения аттрибутов на фронте.
     * @param  Product  $product
     * @return void
     */
    protected function evaluateSelectorAttributes(Product $product): void
    {
        foreach ($product->selectorAttributes as $attr) {
            $this->selectorAttributes[$attr] = [
                'title' => $product->{"attribute{$attr}title"},
                'value' => $product->{"attribute{$attr}value"},
                'options' => $product->variations()
                    ->map(function (Product $variation) use($attr){
                        return [
                            'value' => $variation->{"attribute{$attr}value"},
                            'disable' => $variation->{"attribute{$attr}disable"},
                            'slug' => $variation->slug,
                        ];
                    })
                    ->filter(fn($el) => $el['value'])   // Отфильтровываем пустые
                    ->unique(fn($el) => $el['value'])   // Убираем дубликаты
                    ->toArray()
            ];


        }
    }

    /**
     * Подготавливает атрибуты и разновидности к отображению на фронте.
     * Подготабливает значения каждого атрибута для каждой разновидности.
     * Определяет доступность значения разновидности для текущего набора значений.
     * Скрывает атрибуты с одинаковыми значениями всех разновидностей.
     *
     * @param  Product  $product
     * @return void
     */
    public function prepareAttributesVariations(Product $product)
    {
        $attrs = collect($product->vars_attrs ?? [])
            ->reject('color');
        $fromModel = $attrs->intersect(['width', 'height', 'length', 'depth']);
        $fromAttrs = $attrs->diff($fromModel);

        $attributes = $fromAttrs
            ? Attribute::query()
                ->withTranslation()
                ->whereIn('id', $fromAttrs)
                ->get()
            : collect();

        $attributeValues = $attributes->isNotEmpty()
            ? AttributeValue::query()
                ->withTranslation()
                ->whereIn('attribute_id', $attributes->pluck('id'))
                ->whereIn('product_id', $product->allVariations->pluck('id'))
                ->get()
            : collect();

        // Заполняем названия атрибутов.
        $attrs->each(function ($attr) use($product, $attributes){
            $product->{"attribute{$attr}title"} = is_numeric($attr)
                ? ($attributes->firstWhere('id', $attr)->name ?? '')
                : __("custom::site.{$attr}");
        });

        // Заполняем значения атрибутов для текущей разновидности.
        $attrs->each(function ($attr) use($product, $attributeValues){
            $product->{"attribute{$attr}value"}
                = $this->getProductAttributeValue($product, $attributeValues, $attr);
        });

        // Заполняем значения атрибутов для зависимых разновидностей.
        $product->variations()
            ->each(function (Product $product) use($attrs, $attributes, $attributeValues){
                foreach ($attrs as $attr) {
                    $product->{"attribute{$attr}value"} =
                        $this->getProductAttributeValue($product, $attributeValues, $attr);
                }
            });

        // Скрываем атрибуты с одинаковыми значениями во всех разновидностях.
        $attrs = $attrs->filter(function($attr) use($product) {
            $values = $product->variations()
                ->map->{"attribute{$attr}value"}
                ->push($product->{"attribute{$attr}value"})
                ->toArray();
            // Метод unique специально вынесен что бы применяться к базовой коллекции
            //  а не к коллекции Eloquent
            return collect($values)->unique()->count() > 1;
        });

        // Сохраняем атрибуты в товаре.
        $product->selectorAttributes = $attrs;

        // Определяем статус доступности значения.
        // Т.е. есть ли такая же комбинация атрибутов с разностью в один атрибут.
        $product->variations()
            ->each(function (Product $variation) use($attrs, $product) {
                foreach ($attrs as $attr) {
                    // Исключаем текущий атрибут из проверки
                    $maskAttrs = $attrs->reject($attr);
                    $maskValue = $this->getProductAttributesMask($product, $maskAttrs);
                    $variation->{"attribute{$attr}disable"} =
                        $maskValue !== $this->getProductAttributesMask($variation, $maskAttrs);
                }
            });
    }

    /**
     * Формирует маску сравнения для списка атрибутов.
     *
     * @param  Product  $product
     * @param  Collection  $attrs
     * @return string
     */
    protected function getProductAttributesMask(Product $product, Collection $attrs): string
    {
        return $attrs
            ->map(fn($attr) => Str::slug($product->{"attribute{$attr}value"}))
            ->join('|');
    }

    /**
     * Выбирает значение атрибута для товара.
     *
     * @param  Product  $product
     * @param $attributeValues
     * @param $attribute
     * @return mixed|string
     */
    protected function getProductAttributeValue(Product $product, $attributeValues, $attribute)
    {
        if (is_numeric($attribute)){
            $attributeValue = $attributeValues
                ->where('attribute_id', $attribute)
                ->where('product_id', $product->id)
                ->first();
            $value = $attributeValue->name ?? '';
        } else {
            $value = $product->{$attribute};
        }

        return $value;
    }
}
