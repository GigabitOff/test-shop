<?php

namespace App\Http\Livewire\Manager\Users;

use App\Models\Counterparty;
use App\Models\CounterpartyType;
use App\Models\User;
use Livewire\Component;

class IndexFilterRowLivewire extends Component
{
    public $search = '';
    public $search_list = [];
    public $search_id;

    public $fio = '';
    public $fio_list = [];
    public $fio_id;

    public $company_name = '';
    public $company_name_list = [];
    public $company_name_id;

    public $company_type_list = [];
    public $company_type_id;

    public $role_list = [];
    public $role_id;

    public $date_start;
    public $date_end;

    public $mode = '';

    /** @var User */
    protected $manager;
    protected $revalidateJsItems = [];

    protected $listeners = [
        'eventResetFilters',
        'eventSetFilterToCustomer',
    ];

    public function boot()
    {
        $this->manager = auth()->user();
    }

    public function mount()
    {
        // обновляем список типов контрагентов и ролей
        $this->setAvailableCompanyTypes();
        $this->setAvailableRoles();
    }

    public function updatedSearch($value)
    {
        $this->search_list = $this->searchByAll($value);
        $this->mode = !empty($this->search_list) ? 'search' : '';
    }

    public function updatedFio($value)
    {
        $this->fio_list = $this->searchByName($value);
        $this->mode = !empty($this->fio_list) ? 'fio' : '';
    }

    public function updatedCompanyName($value)
    {
        $this->company_name_list = $this->searchByCompanyName($value);
        $this->mode = !empty($this->company_name_list) ? 'company_name' : '';
    }

    public function updatedCompanyTypeId($value)
    {
        $this->resetLists();
        $this->mode = '';
        $this->emitRevalidateTable();
        $this->updateRoles();
    }

    public function updatedRoleId($value)
    {
        $this->resetLists();
        $this->mode = '';
        $this->emitRevalidateTable();
        $this->updateCompanyTypes();
    }

    public function updatedDateStart($value)
    {
        $this->resetLists();
        $this->mode = '';
        $this->emitRevalidateTable();
        $this->updateRoles();
        $this->updateCompanyTypes();
    }

    public function updatedDateEnd($value)
    {
        $this->resetLists();
        $this->mode = '';
        $this->emitRevalidateTable();
        $this->updateRoles();
        $this->updateCompanyTypes();
    }

    public function render()
    {
        if ($this->revalidateJsItems) {
            $this->emit('revalidate', $this->uniqueJsItems($this->revalidateJsItems));
        }
        return view('livewire.manager.users.index-filter-row-livewire');
    }

    public function setFilteredFio($data)
    {
        $this->fio = $data['value'];
        $this->reset('mode');
        if ($this->fio_id != $data['id']) {
            $this->fio_id = $data['id'];
            $this->emitRevalidateTable();

            $this->updateRoles();
            $this->updateCompanyTypes();
        }
    }

    public function setFilteredSearch($data)
    {
        $this->search = $data['value'];
        $this->reset('mode');
        if ($this->search_id != $data['id']) {
            $this->fio = $this->search;
            $this->search_id = $data['id'];
            $this->fio_id = $data['id'];
            $this->emitRevalidateTable();

            $this->updateRoles();
            $this->updateCompanyTypes();
        }
    }

    public function clearFilteredFio()
    {
        $this->reset(['fio', 'fio_list', 'fio_id']);
        $this->emitRevalidateTable();

        $this->updateRoles();
        $this->updateCompanyTypes();
    }

    public function setFilteredCompanyName($data)
    {
        $this->company_name = $data['value'];
        $this->reset('mode');
        if ($this->company_name_id != $data['id']) {
            $this->company_name_id = $data['id'];
            $this->emitRevalidateTable();

            $this->updateRoles();
            $this->updateCompanyTypes();
        }
    }

    public function clearFilteredCompanyName()
    {
        $this->reset(['company_name', 'company_name_list', 'company_name_id']);
        $this->emitRevalidateTable();

        $this->updateRoles();
        $this->updateCompanyTypes();
    }

    /** События */

    public function eventResetFilters()
    {
        $this->reset([
            'search',
            'search_list',
            'search_id',
            'fio',
            'fio_list',
            'fio_id',
            'company_name',
            'company_name_list',
            'company_name_id',
            'company_type_list',
            'company_type_id',
            'role_list',
            'role_id',
            'date_start',
            'date_end',
        ]);
        $this->updateRoles();
        $this->updateCompanyTypes();
        $this->emitRevalidateTable();
    }

    public function eventSetFilterToCustomer($data)
    {
        $this->reset([
            'fio',
            'fio_list',
            'fio_id',
            'company_name',
            'company_name_list',
            'company_name_id',
            'company_type_list',
            'company_type_id',
            'role_list',
            'role_id',
            'date_start',
            'date_end',
        ]);
        $this->fio = $data['name'] ?? null;
        $this->fio_id = $data['id'] ?? null;
        $this->updateRoles();
        $this->updateCompanyTypes();
        $this->emitRevalidateTable();
    }

    /** Служебные функции */

    protected function emitRevalidateTable()
    {
        $this->emit('eventRevalidateTable', [
            'customerId' => $this->fio_id,
            'customerRoleId' => $this->role_id,
            'counterpartyId' => $this->company_name_id,
            'counterpartyTypeId' => $this->company_type_id,
            'ordersDateFrom' => $this->date_start,
            'ordersDateTo' => $this->date_end,
        ]);
    }

    protected function resetLists()
    {
        $this->reset(['search_list', 'fio_list', 'company_name_list']);
    }

    protected function searchByAll($value)
    {
        return $this->manager->customers()
            ->withTrashed()
            ->where(function ($q) use ($value) {
                $value = trim($value);
                $q->whereTranslationLike('name', "%{$value}%")
                    ->orWhereDigitFieldLike('phone', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%")
                    ->orWhereHas('counterparties', function ($q) use ($value) {
                        $q->where('name', 'like', "%{$value}%");
                        $q->orWhereDigitFieldLike('okpo', "%{$value}%");
                    });
            })
            ->take(10)->get()->keyBy('id')->toArray();
    }

    protected function searchByName($value)
    {
        $value = trim($value);
        return $this->customersFilter($this->manager->customers())
            ->withTrashed()
            ->whereUserNameLike("%{$value}%")
            ->take(10)->get()->keyBy('id')->toArray();
    }

    protected function searchByCompanyName($like)
    {
        $customersQuery = $this->customersFilter($this->manager->customers());
        return Counterparty::query()->where('name', 'like', "%{$like}%")
            ->whereHas('customers', function ($q) use ($customersQuery) {
                $q->whereIn('id', $customersQuery->pluck('id'));
            })
            ->take(10)->get()->keyBy('id')->toArray();
    }

    protected function setAvailableCompanyTypes()
    {
        $customersQuery = $this->customersFilter($this->manager->customers());

        $this->company_type_list = CounterpartyType::query()
            ->withTranslation()
            ->whereHas('counterparties', function ($q) use($customersQuery){
                $q->whereHas('users', function ($q2) use ($customersQuery) {
                    $q2->whereIn('id', $customersQuery->pluck('id'));
                });
            })
            ->get()->keyBy('id')->toArray();

        $this->revalidateJsCompanyTypeSelect();

    }

    protected function setAvailableRoles()
    {
        $roles = [];
        $query = $this->customersFilter($this->manager->customers());
        if ($query->clone()->whereSimpleCustomer()->count()) {
            $roles['simple'] = __('custom::site.customer');
        }
        if ($query->clone()->whereLegalAdminCustomer()->count()) {
            $roles['legal_admin'] = __('custom::site.customer_legal_admin');
        }
        if ($query->clone()->whereLegalAdminCustomer()->count()) {
            $roles['legal_user'] = __('custom::site.customer_legal_user');
        }

        $this->role_list = $roles;
    }

    protected function customersFilter($query)
    {
        $query->withTrashed();

        if ($this->fio_id) {
            $query->whereUserId($this->fio_id);
        }
        if ($this->role_id) {
            $query->whereCustomerType($this->role_id);
        }
        if ($this->company_name_id) {
            $query->whereCounterpartyId($this->company_name_id);
        }
        if ($this->company_type_id) {
            $query->whereCounterpartyType($this->company_type_id);
        }
        if ($this->date_start) {
            $query->whereUserOrdersDateFrom($this->date_start);
        }

        if ($this->date_end) {
            $query->whereUserOrdersDateTo($this->date_end);
        }
        return $query;
    }

    private function updateRoles()
    {
        if (!$this->role_id) {
            $this->setAvailableRoles();
            $this->revalidateJsRoleSelect();
        }
    }

    private function updateCompanyTypes()
    {
        if (!$this->company_type_id) {
            $this->setAvailableCompanyTypes();
            $this->revalidateJsCompanyTypeSelect();
        }
    }

    private function revalidateJsRoleSelect()
    {
        $this->revalidateJsItems['nice_select'][] =
            '.lk-user-table-filter select[name="role"]';
    }

    private function revalidateJsCompanyTypeSelect()
    {
        $this->revalidateJsItems['nice_select'][] =
            '.lk-user-table-filter select[name="company_type"]';
    }

    private function uniqueJsItems($data)
    {
        foreach ($data as &$item) {
            $item = array_unique($item);
        }
        return $data;
    }
}
