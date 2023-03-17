<?php

namespace App\Http\Livewire\Customer\Comparisons;

use App\Models\Attribute;
use Illuminate\Support\Str;
use Livewire\Component;

class ProductDetailsLivewire extends Component
{
    public $products;

    public function __construct($products = [])
    {
        parent::__construct();
        $this->products = $products;
    }

    public function render()
    {
        $products = $this->products;
        $attributes = $this->revalidateAttributes($products);

        return view(
            'livewire.customer.comparisons.product-details-livewire',
            compact('products', 'attributes')
        );
    }

    public function productAttributeValuesLine($product, $attribute_id)
    {
        $termsLine = $product->attributeValues
            ->where('attribute_id', $attribute_id)
            ->map->name->join(', ');

        return Str::limit($termsLine, 24);
    }

    private function revalidateAttributes($products)
    {
        $attributes = Attribute::query()
            ->withTranslation()
            ->whereHas('products', fn($q) => $q->whereIn('products.id', $products->pluck('id')))
            ->orderByTranslation('name')
            ->get()->keyBy('id')->map->name;

        return $attributes;
    }
}
