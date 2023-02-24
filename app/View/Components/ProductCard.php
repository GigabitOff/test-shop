<?php

namespace App\View\Components;

use App\Models\Product;
use App\Traits\WithExpandProduct;
use Illuminate\View\Component;

class ProductCard extends Component
{
    use WithExpandProduct;

    public Product $product;
    public string $cardClasses;
    public bool $showIntro;

    public function __construct(Product $product, string $cardClasses = '', bool $showIntro = false)
    {
        $this->product = $product;
        $this->cardClasses = $cardClasses;
        $this->showIntro = $showIntro;

        $this->expandProductAvailability($product);
        $this->expandProductMainImageUrl($product);
        $this->expandProductBrandImageUrl($product);
        $this->expandProductCategory($product);
        $this->expandProductUniqColorVariations($product);
        $this->expandProductUniqCardAttributeVariations($product);
    }

    public function render()
    {
        return view('components.product-card');
    }
}
