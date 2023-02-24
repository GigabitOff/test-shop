<?php

namespace App\Http\Livewire\Catalog\Product;

use App\Models\Product;
use App\Traits\WithExpandProduct;
use Illuminate\Support\Collection;
use Livewire\Component;

class ShowGallerySectionLivewire extends Component
{
    use WithExpandProduct;

    // Filled from caller
    public Product $product;

    public Collection $images;
    public function mount()
    {
        $this->images = $this->product->images()
            ->orderBy('main', 'desc')->get();
    }
    public function render()
    {
        $this->expandProductBrandImageUrl($this->product);

        return view('livewire.catalog.product.show-gallery-section-livewire');
    }

}
