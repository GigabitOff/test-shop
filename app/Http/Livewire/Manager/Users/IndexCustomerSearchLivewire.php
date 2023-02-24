<?php

namespace App\Http\Livewire\Manager\Users;

use App\Models\User;
use Livewire\Component;

class IndexCustomerSearchLivewire extends Component
{
    public int $user_id = 0;
    public $search = '';
    public $search_list = [];
    public $searched_id;

    public $mode = '';

    /** @var User */
    protected $manager;

    protected $queryString = [
        'user_id' => ['except' => 0],
    ];

    protected $listeners = [
        'eventResetFilters',
    ];

    public function boot()
    {
        $this->manager = auth()->user();
    }

    public function mount()
    {
        if ($this->user_id && ($user = User::find($this->user_id))) {
            $this->search = $user->name;
            $this->searched_id = $this->user_id;
        }
    }

    public function updatedSearch($value)
    {
        $this->search_list = $this->searchByName($value);
        $this->mode = !empty($this->search_list) ? 'search' : '';
    }

    public function render()
    {
        return view('livewire.manager.users.index-customer-search-livewire');
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
        $this->reset(['search', 'search_list', 'searched_id', 'mode', 'user_id']);
    }

    /** События */

    public function eventResetFilters()
    {
        $this->clearFilteredSearch();
    }

    /** Служебные функции */

    protected function searchByName($like)
    {
        return $this->manager->customers()->withTrashed()
            ->whereTranslationLike('name', "%{$like}%")
            ->take(10)->get()->keyBy('id')->toArray();
    }
}
