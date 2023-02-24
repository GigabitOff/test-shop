<?php

namespace App\Http\Livewire\Customer\Comparisons;

use App\Models\Attribute;
use App\Models\Term;
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

    public function productTermsLine($product, $attribute_id)
    {
        $termsLine = $product->terms
            ->where('attribute_id', $attribute_id)
            ->map->value->join(', ');

        return Str::limit($termsLine, 24);
    }

    public function productAttributeTermIds($product, $attribute_id)
    {
        return $product->terms
            ->where('attribute_id', $attribute_id)
            ->map->id->join(',');
    }

    /** Service Functions */

    private function revalidateProducts()
    {
        return $this->customer
            ->compareProducts()->withTerms()->get();
    }

    private function revalidateAttributes($products)
    {
        $attributes = Attribute::query()
            ->withTranslation()
            ->whereHas('products', fn($q)=>$q->whereIn('id', $products->pluck('id')))
            ->orderByTranslation('name')
            ->get()->keyBy('id')->map->name;

        return $attributes;
    }
}
