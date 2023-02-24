<?php

namespace App\Http\Livewire\Customer\Users;

use App\Http\Livewire\Traits\WithPerPage;
use App\Models\User;
use App\Services\UsersService;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class IndexContentLivewire extends Component
{
    use WithPagination;
    use WithPerPage;

    public User $leader;

    public $display = 'all';

    public $count_all = 0;
    public $count_new = 0;
    public $count_change = 0;
    public $count_deleted = 0;
    public $count_moderation = 0;

    public $roles_select = [];

    public $filteredCustomerId;
    public $filteredPosition;
    public $filteredOrdersDateFrom;
    public $filteredOrdersDateTo;

    protected string $paginationTheme = 'paginator-buttons';
    protected $customers;
    protected array $revalidateJsItems = [];

    protected $queryString = [
        'display' => ['except'=>'all'],
    ];

    protected $listeners = [
        'eventCustomerAdded',
        'eventCustomerChanged',
        'eventRevalidateTable',
        'eventDeleteCustomerConfirm',
    ];

    public function mount()
    {
        $this->reinitData();
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->revalidateFootable();
    }

    public function render()
    {
        if (!$this->customers){
            $this->reinitData();
        }

        if ($this->revalidateJsItems) {
            $this->emit('revalidate', $this->revalidateJsItems);
        }

        $this->roles_select = Role::all();

        return view('livewire.customer.users.index-content-livewire', [
            'customers' => $this->customers,
            'iterated' => 0,
            'roles_select' => $this->roles_select,
            'phone' => '',
            'shop_cities' => [],
            'counterparties_select' => []
        ]);
    }

    public function setDisplay($display = 'all')
    {
        if ($this->display !== $display) {
            $this->display = $display;
            $this->resetPage();
//            $this->resetFiltered();
            $this->reinitData();
        }
    }

//    public function restoreCustomer($id, UsersService $service)
//    {
//        if ($customer = User::find($id)){
//            $service->restoreLegal($customer);
//            $this->reinitData();
//        }
//    }

//    public function deleteCustomer($id, UsersService $service)
//    {
//        if ($customer = User::find($id)){
//            $service->deleteLegal($customer);
//            $this->reinitData();
//        }
//    }

//     // Отсоединяем пользователя от контрагентов и контрактов
//    public function destroyCustomer($id, UsersService $service)
//    {
//        if ($customer = User::find($id)){
//            $service->detachLegalPermanently($customer);
//            $this->reinitData();
//        }
//    }

    /** Обработчики событий */
    public function eventCustomerAdded()
    {
        $this->reinitData();
    }
    public function eventCustomerChanged()
    {
        $this->reinitData();
    }

    public function eventRevalidateTable($data)
    {
        $this->filteredCustomerId = $data['customerId'];
        $this->filteredPosition = $data['position'];
        $this->filteredOrdersDateFrom = $data['ordersDateFrom'];
        $this->filteredOrdersDateTo = $data['ordersDateTo'];
        $this->resetPage();
        $this->reinitData();
    }

    public function eventDeleteCustomerConfirm($payload, UsersService $service)
    {
        if ($user = User::find($payload['customerId'] ?? 0)){
           $service->detachLegalPermanently($user);

            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.message'),
                'message' => __('custom::site.customer_deleted'),
                'state' => 'success',
            ]);
        }
    }

    /** Служебные функции */

    protected function reinitData()
    {
        /**
         * Пользователем здесь может быть только Админ Контрагента.
         * @var User $leader;
         */
        $leader = auth()->user();

        $this->count_all = $leader->customers()->withoutLegalDeleted()->count();
        $this->count_new = $leader->customers()->onlyNew()->count();
        $this->count_change = $leader->customers()->hasChanges()->count();
        $this->count_deleted = $leader->customers()->onlyLegalDeleted()->count();
        //$this->count_moderation = $leader->customers()->onModeration()->count();


        $query = $leader->customers()->with('counterparties');
        $query = $this->useFiltered($query);
        $query = $this->useDisplay($query);

        $customers = $query->paginate($this->getPerPageValue());

        $this->leader = $leader;
        $this->customers = $customers;

        $this->revalidateFootable();
    }

    protected function useDisplay($query)
    {
        switch ($this->display) {
            case 'new':
                $query->onlyNew();
                break;
            case 'deleted':
                $query->onlyLegalDeleted();
                break;
            /*case 'moderation':
                $query->onModeration();
                break;*/
            case 'changed':
                $query->hasChanges();
                break;
            default:
                $query->withTrashed();
        }
        return $query;
    }

    protected function useFiltered($query)
    {
        if ($this->filteredCustomerId) {
            $query->whereUserId($this->filteredCustomerId);
        }
        if ($this->filteredPosition) {
            $query->whereUserPosition($this->filteredPosition);
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
        $this->revalidateJsItems['footable'] = ['.lk-page__table .ftable'];
    }
}
