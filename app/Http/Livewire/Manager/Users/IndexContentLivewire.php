<?php

namespace App\Http\Livewire\Manager\Users;

use App\Http\Livewire\Traits\WithPerPage;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class IndexContentLivewire extends Component
{
    use WithPagination;
    use WithPerPage;

    public int $user_id = 0;
    public $display = 'all';

    public $count_all = 0;
    public $count_new = 0;
    public $count_change = 0;
    public $count_moderation = 0;
    public $count_deleted = 0;

    public $filteredCustomerId;
    public $filteredCustomerRoleId;
    public $filteredCounterpartyId;
    public $filteredCounterpartyTypeId;
    public $filteredOrdersDateFrom;
    public $filteredOrdersDateTo;

    protected $paginationTheme = 'paginator-buttons';
    protected $customers;
    protected $manager;
    protected $revalidateJsItems = [];

    protected $queryString = [
        'display' => ['except' => 'all'],
        'user_id' => ['except' => 0],
    ];

    protected $listeners = [
        'eventCustomerCreated',
        'eventCustomerAdded',
        'eventCustomerChanged',
        'eventRevalidateTable',
    ];

    public function mount()
    {
        if ($this->user_id && User::where('id', $this->user_id)->exists()) {
            $this->filteredCustomerId = $this->user_id;
        }

        $this->reinitData();
    }

    public function render()
    {
        if (!$this->customers) {
            $this->reinitData();
        }

        if ($this->revalidateJsItems) {
            $this->emit('revalidate', $this->revalidateJsItems);
        }

        return view('livewire.manager.users.index-content-livewire', [
            'customers' => $this->customers,
            'manager' => $this->manager,
            'iterated' => 0//$this->getIterated(),
        ]);
    }

    public function deleteCustomer($id)
    {
        if ($customer = UserRepository::getCustomerById($id)) {
            $customer->delete();
            $this->reinitData();
        }
    }

    public function restoreCustomer($id)
    {
        if ($customer = UserRepository::getCustomerById($id, true)) {
            $customer->restore();
            $this->reinitData();
        }
    }

    public function setDisplay($display = 'all')
    {
        $this->display = $display;
        $this->resetPage();
        $this->resetFiltered();
        $this->reinitData();
    }

    public function onPerPageChanged($value)
    {
        $this->reinitData();
    }

    /** События */

    public function eventCustomerChanged()
    {
        $this->reinitData();
    }

    public function eventCustomerAdded()
    {
        $this->reinitData();
    }

    public function eventCustomerCreated()
    {
        $this->reinitData();
    }

    public function eventRevalidateTable($filters)
    {
        $this->filteredCustomerId = $filters['customerId'] ?? null;
        $this->filteredCustomerRoleId = $filters['customerRoleId'] ?? null;
        $this->filteredCounterpartyId = $filters['counterpartyId'] ?? null;
        $this->filteredCounterpartyTypeId = $filters['counterpartyTypeId'] ?? null;
        $this->filteredOrdersDateFrom = $filters['ordersDateFrom'] ?? null;
        $this->filteredOrdersDateTo = $filters['ordersDateTo'] ?? null;
        $this->resetPage();
        $this->reinitData();
    }

    /** Служебные функции */

    protected function resetFiltered()
    {
        $this->reset(['filteredCounterpartyId', 'filteredCustomerId']);
    }

    protected function reinitData()
    {
        /** @var User $manager */
        $manager = auth()->user();

        $this->count_all = $this->useFiltered($manager->customers())->count();
        $this->count_new = $this->useFiltered($manager->customers())->onlyNew()->count();
        $this->count_change = $this->useFiltered($manager->customers())->hasChanges()->count();
        $this->count_deleted = $this->useFiltered($manager->customers())->onlyTrashed()->count();
//        $this->count_moderation = $this->useFiltered($manager->customers())->onModeration()->count();

        $query = $manager->customers()
            ->with(['counterparties.founder', 'translations', 'changes', 'roles'])
            ->with('manager.translations');

        $query = $this->useFiltered($query);
        $query = $this->useDisplay($query);

        $customers = $query->paginate($this->getPerPageValue());

        $this->customers = $customers;
        $this->manager = $manager;

        $this->revalidateFootable();
    }

    protected function useDisplay($query)
    {
        switch ($this->display) {
            case 'new':
                $query->onlyNew();
                break;
            case 'deleted':
                $query->onlyTrashed();
                break;
            case 'changed':
                $query->hasChanges();
                break;
            default:
                //$query->withTrashed();
        }
        return $query;
    }

    protected function useFiltered($query)
    {
        if ($this->filteredCustomerId) {
            $query->whereUserId($this->filteredCustomerId);
        }
        if ($this->filteredCustomerRoleId) {
            $query->whereCustomerType($this->filteredCustomerRoleId);
        } else {
            $query->onlyRegistered();
        }
        if ($this->filteredCounterpartyId) {
            $query->whereCounterpartyId($this->filteredCounterpartyId);
        }
        if ($this->filteredCounterpartyTypeId) {
            $query->whereCounterpartyType($this->filteredCounterpartyTypeId);
        }

        if ($this->filteredOrdersDateFrom) {
            $query->whereUserOrdersDateFrom($this->filteredOrdersDateFrom);
        }

        if ($this->filteredOrdersDateTo) {
            $query->whereUserOrdersDateTo($this->filteredOrdersDateTo);
        }

        return $query;
    }

    private function revalidateFootable()
    {
        $this->revalidateJsItems['footable'] = ['.lk-user-table-body .js-table'];
    }
}
