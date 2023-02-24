<?php

namespace App\Http\Livewire\Customer\Users;

use App\Models\User;
use Livewire\Component;

class IndexCustomerSearchLivewire extends Component
{
    public $search = '';
    public $search_list = [];
    public $searched_id;

    public $mode = '';

    /** @var User */
    protected $leader;

    protected $listeners = [
        'eventResetFilters',
    ];

    public function boot()
    {
        $this->leader = auth()->user();
    }

    public function updatedSearch($value)
    {
        $this->search_list = $this->searchByName($value);
        $this->mode = !empty($this->search_list) ? 'search' : '';
    }

    public function render()
    {
        return view('livewire.customer.users.index-customer-search-livewire');
    }

    public function setFilteredSearch($data)
    {
        $this->search = $data['value'];
        $this->reset('mode');
        if ($this->searched_id != $data['id']) {
            $this->searched_id = $data['id'];
            $this->emit('eventSetFilterToCustomer', [
                'id' => $this->searched_id,
                'name' => $this->search,
            ]);
        }
    }

    public function clearFilteredSearch()
    {
        $this->reset(['search', 'search_list', 'searched_id', 'mode']);
    }

    /** События */

    public function eventResetFilters()
    {
        $this->clearFilteredSearch();
    }

    /** Служебные функции */

    protected function searchByName($like)
    {
        return $this->leader->customers()->withTrashed()
            ->whereTranslationLike('name', "%{$like}%")
            ->take(10)->get()->keyBy('id')->toArray();
    }
}
