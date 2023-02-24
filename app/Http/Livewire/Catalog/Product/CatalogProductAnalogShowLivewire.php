<?php

namespace App\Http\Livewire\Catalog\Product;

use Livewire\Component;

class CatalogProductAnalogShowLivewire extends Component
{
    public $item_id, //category_id
    $products,
    $data,
        $category,
    $perPage = 5,
    $search='';

    public function mount()
    {
       $this->category = $this->data;
    }
    public function render()
    {
        return view('livewire.catalog.product.catalog-product-analog-show-livewire');
    }
}
