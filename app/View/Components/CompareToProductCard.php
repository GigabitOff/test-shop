<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\Support\Collection;

class CompareToProductCard extends ProductCard
{
    public Collection $attrs;

    public function __construct(Product $product, $attrs = [])
    {
        parent::__construct($product);
        $this->attrs = $attrs;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.compare-to-product-card');
    }
}
