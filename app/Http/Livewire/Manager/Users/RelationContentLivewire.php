<?php

namespace App\Http\Livewire\Manager\Users;

use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Counterparty;
use App\Models\User;
use App\Repositories\UserRepository;
use Livewire\Component;
use Livewire\WithPagination;

class RelationContentLivewire extends Component
{
    use WithPagination;
    use WithPerPage;

    public ?User $manager;   // Пользователем здесь может быть либо Менеджер либо Главный менеджер.

    public string $display = 'all';
    public string $search = '';

    public int $count_all = 0;
    public int $count_moderation = 0;
    public int $count_not_approved = 0;
//    public $count_new = 0;
//    public $count_change = 0;
//    public $count_deleted = 0;

    protected string $paginationTheme = 'paginator-buttons';
    protected $counterparties;

    protected $queryString = [
        'display' => ['except' => 'all'],
    ];

    protected $listeners = [
        'eventCustomerAdded' => 'eventHandler',
        'eventCustomerChanged' => 'eventHandler',
        'eventCounterpartyChanged' => 'eventHandler',
        'eventCounterpartyCreated' => 'eventHandler',
        'eventCounterpartyFounderChanged' => 'eventHandler',
        'eventCustomerConnected' => 'eventCustomerConnected'
        //'eventApproveCounterparty' => 'eventApproveCounterparty',
    ];

    public function mount()
    {
        $this->manager = auth()->user();
        $this->reInitData();
    }

    public function render()
    {
        if (!$this->counterparties) {
            $this->reInitData();
        }

        $this->dispatchBrowserEvent('updateFooData');

        $table = view('livewire.manager.users.relation-footable-render', [
            'counterparties' => $this->counterparties,
            'display' => $this->display,
            'iterated' => 0//$this->getIterated(),
        ])->render();

        return view('livewire.manager.users.relation-content-livewire', [
            'counterparties' => $this->counterparties,
            'table' => $table
        ]);
    }

    public function resetSearch()
    {
        $this->reset('search');
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

    public function setDisplay($filter = 'all')
    {
        if ($this->display !== $filter) {
            $this->display = $filter;
            $this->reset('search');
            $this->reInitData();
        }
    }

    public function eventHandler()
    {
        $this->reInitData();
    }

    public function eventCustomerConnected($contractId = 0)
    {
        $this->skipRender();
    }

    public function eventApproveCounterparty($id)
    {
        Counterparty::query()
            ->where('id', (int)$id)
            ->update(['approved' => true]);
    }


    protected function reInitData()
    {
        $sub = $this->manager->customers()->select('id')->toRawSql();
        $query = Counterparty::query()
            ->whereHas('users', fn($q) => $q->whereInRaw('id', $sub));

        $this->count_all = $query->clone()->count();
        $this->count_moderation = $query->clone()->onModeration()->count();
        $this->count_not_approved = 0;//$query->clone()->notApproved()->count();
//        $this->count_new = $query->clone()->onlyNew()->count();
//        $this->count_change = $query->clone()->hasChanges()->count();
//        $this->count_deleted = $query->clone()->onlyTrashed()->count();

        // Eager loading
        $query = $query->clone()
            ->with('type.translations')
            ->with('founder', function ($q) {
                $q->withTranslation()->with(['changes', 'roles']);
            });

        if ($value = trim($this->search)) {
            $query->where(function ($q) use ($value) {
                $q->where('name', 'like', "%{$value}%")
                    ->orWhere('okpo', 'like', "%{$value}%")
                    ->orWhere('phone', 'like',"%{$value}%")
                    ->orWhereHas('users', function($q) use($value){
                        $q->whereTranslationLike('name', "%{$value}%")
                            ->orWhere('phone', 'like', "%{$value}%")
                            ->orWhere('position', 'like', "%{$value}%");
                    });
            });
        }

        $query = $this->useDisplay($query);

        $this->counterparties = $query->paginate($this->getPerPageValue());
    }

    protected function useDisplay($query)
    {
        switch ($this->display) {
            case 'moderation':
                $query->onlyModerated();
                break;
        }
        return $query;
    }
}
