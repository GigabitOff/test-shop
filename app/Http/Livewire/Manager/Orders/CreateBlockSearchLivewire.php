<?php

namespace App\Http\Livewire\Manager\Orders;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class CreateBlockSearchLivewire extends Component
{

    use WithPagination;
    use WithPerPage;
    use WithFilterableDropdown;

    public array $filterableProductName = [];
    public array $filterableSearch = [];

    protected $listeners = [
        'eventBulkOrderProductsUploaded',
    ];

    protected string $paginationTheme = 'paginator-buttons';

    public function mount()
    {
        $this->initFilterable();
    }

    public function render()
    {
        $products = $this->extractProducts();
        $table = view('livewire.manager.orders.create-footable-render', [
            'products' => $products,
        ])->render();
        $this->dispatchBrowserEvent('updateFooData');
        return view('livewire.manager.orders.create-block-search-livewire', [
            'products' => $products,
            'table' => $table,
            'filterableMode' => $this->filterableMode,
        ]);
    }

    public function updated($field, $value)
    {
        $this->updatedFilterable($field, $value);
    }

    public function clearSearchList()
    {
        $this->resetFilterable('filterableSearch');
        $this->resetFilterable('filterableProductName');
    }

    protected function onSetFilterable($key, $id, $name)
    {
        $this->resetPage();
    }

    protected function onResetFilterable($key)
    {
        $this->resetPage();
    }

    public function eventBulkOrderProductsUploaded()
    {
        // Just revalidate
    }

    /** Служебные функции */

    private function searchQuery($value): Builder
    {
        if ($value = trim($value)) {
            return Product::query()
                ->whereTranslationLike('name', "%{$value}%")
                ->orWhere('articul', 'like', "%{$value}%")
                ->orWhere('articul_search', 'like', "%{$value}%")
                ->orWhereHas('brand', function ($q) use ($value) {
                    $q->whereTranslationLike('title', "%{$value}%");
                });
        } else {
            // Это нужно что бы метод всегда возвращал валидный запрос.
            return Product::query();
        }
    }

    private function extractProducts(): LengthAwarePaginator
    {
        $query = $this->searchQuery($this->filterableSearch['value']);

        if ($this->filterableSearch['id']){
            $query = $query->whereId($this->filterableSearch['id']);
        }

        $products = $query->paginate($this->getPerPageValue());

        // Добавляем параметр количества в корзине.
        $products->getCollection()
            ->each(function($product){
                if ($inCart = cart()->products()->find($product->id)){
                    $product->cartQuantity = $inCart->cartQuantity;
                } else {
                    $product->cartQuantity = 0;
                }
            });

        return $products;
    }

    private function setFilterableProductNameList($value)
    {
//        $this->resetPage();
//        $this->resetFilterable('filterableProductName');
//        return $this->searchQuery($value)
//            ->take(10)->get()->keyBy('id')->map->name->toArray();
//
    }

    private function setFilterableSearchList($value): array
    {
        $this->resetPage();
        $this->resetFilterable('filterableProductName');
//        return $this->searchQuery($value)
//            ->take(10)->get()->keyBy('id')->map->name->toArray();
        return [];
    }

}
