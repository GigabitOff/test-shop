<?php

namespace App\Http\Livewire\Customer\Comparisons;

use App\Models\Attribute;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;

class PageMainLivewire extends Component
{

    protected User $customer;

    public function boot()
    {
        $this->customer = auth()->user();
    }

    public function render()
    {
        $products = $this->revalidateProducts();
        $attributes = $this->revalidateAttributes($products);

        return view(
            'livewire.customer.comparisons.page-main-livewire',
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

    public function productAttributeValuesId($product, $attribute_id)
    {
        return $product->attributeValues
            ->where('attribute_id', $attribute_id)
            ->map->id->join(',');
    }

    /** Service Functions */

    protected function revalidateProducts()
    {
        return $this->customer
            ->compareProducts()
            ->with(['attributes', 'attributeValues'])
            ->get();
    }

    protected function revalidateAttributes($products)
    {
        $attributes = Attribute::query()
            ->withTranslation()
            ->whereHas('products', fn($q) => $q->whereIn('products.id', $products->pluck('id')))
            ->orderByTranslation('name')
            ->get()->keyBy('id')->map->name;

        return $attributes;
    }
}
