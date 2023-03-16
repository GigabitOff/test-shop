<?php

namespace App\Http\Livewire\Customer\Comparisons;

class ProductDetailsLivewire extends PageMainLivewire
{
    public function render()
    {
        $products = $this->revalidateProducts();
        $attributes = $this->revalidateAttributes($products);

        return view(
            'livewire.customer.comparisons.product-details-livewire',
            compact('products', 'attributes')
        );
    }
}
