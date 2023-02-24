<?php

namespace App\Http\Livewire\Customer\Favorites;

use App\Models\Product;
use Livewire\Component;

class IndexSearchLivewire extends Component
{
    public $search = '';
    public $search_list = [];
    public $search_id;

    public $mode = '';

    public function updatedSearch($value)
    {
        $this->search_list = $this->searchLike($value);
        $this->mode = !empty($this->search_list) ? 'search' : '';
    }

    public function render()
    {
        return view('livewire.customer.favorites.index-search-livewire');
    }

    public function setSearched($data)
    {
        $this->search = $data['value'];
        $this->reset('mode');
        if ($this->search_id != $data['id']) {
            $this->search_id = $data['id'];
            $this->emit('eventAddFavouriteItem', [
                'product_id' => $this->search_id,
            ]);
        }
    }

    public function clearFilteredSearch()
    {
        $this->reset(['search', 'search_list', 'search_id', 'mode']);
    }

    /** События */

    /** Служебные функции */

    protected function searchLike($like)
    {
        return Product::query()
            ->whereTranslationLike('name', "%{$like}%")
            ->orWhere('articul', 'like', "%{$like}%")
            ->orWhere('articul_search', 'like', "%{$like}%")
            ->take(10)->get()->keyBy('id')->toArray();
    }
}
