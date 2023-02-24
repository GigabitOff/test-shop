<?php

namespace App\Http\Livewire\Catalog\Category;

use Livewire\Component;

class CatalogCategoryShowSingleLivewire extends Component
{
    public $item_id, $data, $perPage = 5, $search='';

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.catalog.category.catalog-category-show-single-livewire');
    }
}
