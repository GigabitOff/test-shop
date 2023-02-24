<?php

namespace App\Http\Livewire\Catalog\Product;

use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Component;

class ShowRelatedSectionLivewire extends Component
{
    public Product $product;

    public function render()
    {
        return view('livewire.catalog.product.show-related-section-livewire', [
            'productsRelated' => $this->evaluateRelatedProducts(),
        ]);
    }

    protected function evaluateRelatedProducts(): Collection
    {
        return $this->product->accompanying;
    }
}
