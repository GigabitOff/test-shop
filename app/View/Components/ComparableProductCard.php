<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\Support\Collection;

class ComparableProductCard extends ProductCard
{
    public Collection $attrs;
    public bool $isActive;

    public function __construct(Product $product, $attrs = [], $isActive = true)
    {
        parent::__construct($product, '', false);
        $this->attrs = $attrs;
        $this->isActive = $isActive;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.comparable-product-card');
    }

}
