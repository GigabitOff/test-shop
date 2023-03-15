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

    /**
     * Generate CRC32 hash of the string
     *
     * @param $product
     * @param $attribute_id
     * @return string
     */
    public function productAttributeValuesHash($product, $attribute_id)
    {
        return dechex(crc32(
            $product->attributeValues
                ->where('attribute_id', $attribute_id)
                ->map->name->join('')
        ));
    }

    public function productAttributeIds($product)
    {
        return $product->attributes->map->id;
    }

    /** Service Functions */

    private function revalidateProducts()
    {
        return $this->customer
            ->compareProducts()
            ->with(['attributes', 'attributeValues'])
            ->get();
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
