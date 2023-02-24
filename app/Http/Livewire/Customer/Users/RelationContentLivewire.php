<?php

namespace App\Http\Livewire\Customer\Users;

use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Contract;
use App\Models\Counterparty;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class RelationContentLivewire extends Component
{
    use WithPagination;
    use WithPerPage;


    public string $display = 'all';
    public string $search = '';

    public int $count_all = 0;
    public int $count_new = 0;
    public int $count_change = 0;
    public int $count_moderation = 0;
    public int $count_deleted = 0;

    protected string $paginationTheme = 'paginator-buttons';
    protected $customers = [];
    protected ?User $leader; // Пользователем здесь может быть только Админ Контрагента.

    protected $queryString = [
        'display' => ['except' => 'all'],
    ];

    protected $listeners = [
        'eventCustomerCreated' => 'revalidate',
        'eventCustomerAdded' => 'revalidate',
        'eventCustomerChanged' => 'revalidate',
        'eventCounterpartyCreated' => 'revalidate',
        'eventCounterpartyChanged' => 'revalidate',
        'eventCustomerConnected' => 'eventCustomerConnected',
        'eventDetachUserFromContract' => 'eventDetachUserFromContract'
    ];

    public function boot()
    {
        $this->leader = auth()->user();
    }

    public function render()
    {
        if (!$this->customers) {
            $this->reinitData();
        }

        $this->dispatchBrowserEvent('updateFooData');

        $table = view('livewire.customer.users.relation-footable-render', [
            'customers' => $this->customers,
            'customer' => $this->leader,
        ])->render();

        return view('livewire.customer.users.relation-content-livewire', [
            'customers' => $this->customers,
            'customer' => $this->leader,
            'table' => $table,
        ]);
    }

    public function resetSearch()
    {
        $this->reset('search');
    }

    public function deleteCustomer($id)
    {
        $customer = User::find($id);
        if ($customer && $customer->isCustomerLegalUser) {
            $customer->delete();
            $this->reinitData();
        }
    }

    public function restoreCustomer($id)
    {
        if ($customer = User::find($id)) {
            $customer->restore();
            $this->reinitData();
        }
    }

    public function eventDetachUserFromContract($data)
    {
        if ($customer = User::find((int)($data['customer_id'] ?? 0))) {
            UserRepository::removeCustomerContracts($customer, (array)$data['contract_id']);

            $this->dispatchRedrawContractUsers($data['contract_id']);
            $this->skipRender();
        }
    }

    public function setDisplay($display = 'all')
    {
        if ($this->display !== $display) {
            $this->display = $display;
            $this->reset('search');
            $this->reinitData();
        }
    }

    public function revalidate()
    {
        $this->reinitData();
    }

    public function eventCustomerConnected($contractId = 0)
    {
        $this->dispatchRedrawContractUsers($contractId);
        $this->skipRender();
    }

    /** Служебные функции */

    protected function dispatchRedrawContractUsers($contractId)
    {
        $contract = Contract::find($contractId);

        if ($contract) {
            $html = view('livewire.customer.users.includes.contract-users', [
                'contract' => $contract,
            ])->render();

            $this->dispatchBrowserEvent('eventUpdateContractUsers', [
                    'contract' => $contractId,
                    'html' =>  $html
                ]
            );
        }
    }

    protected function reinitData()
    {

        $query = $this->leader->customers();

        //$this->count_all = $query->onlyModerated()->count();
        //$this->count_moderation = $query->onModeration()->count();

        /* $this->count_all = $query->clone()->onModeration()->withTrashed()->count();
         $this->count_moderation = $query->clone()->onlyModerated()->count();
         $this->count_new = $query->clone()->onlyNew()->count();
         $this->count_change = 0;//$query->clone()->hasChanges()->count();
         $this->count_deleted =  $query->clone()->onlyDeleted()->withTrashed()->count();*/

        // Eager loading
        /*$query->with('type.translations')
            ->with('founder', function ($q) {
                $q->withTranslation()->with(['changes', 'roles']);
            });*/

        if ($value = trim($this->search)) {
           /* $query->where(function ($q) use ($value) {
                $q->where('name', 'like', "%{$value}%")
                    ->orWhere('okpo', 'like', "%{$value}%")
                    ->orWhere('phone', 'like',"%{$value}%")
                    ->orWhereHas('users', function($q) use($value){
                        $q->whereTranslationLike('name', "%{$value}%")
                            ->orWhere('phone', 'like', "%{$value}%")
                            ->orWhere('position', 'like', "%{$value}%");
                    });
            });*/
        }

        $query = $this->useDisplay($query);

        $this->customers = $query->paginate($this->getPerPageValue());
    }

    protected function useDisplay($query)
    {
        switch ($this->display) {
            /*case 'moderation':
                $query->onModeration();
                break;
            default:
                $query->onlyModerated();*/
           /* case 'new':
                $query->onlyNew();
                break;
            case 'deleted':
                $query->onlyDeleted()->withTrashed();
                break;
            case 'moderation':
                $query->onlyModerated();
                break;
            case 'changed':
                $query->hasChanges();
                break;
            default:
                $query->withTrashed();*/
            //default:
            //    $query->onlyModerated();
        }
        return $query;
    }
}
