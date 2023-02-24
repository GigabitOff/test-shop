<?php

namespace App\Http\Livewire\Manager\Debts;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Contract;
use App\Models\ContractDebt;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPageMainLivewire extends Component
{
    use WithPagination;
    use WithPerPage;
    use WithFilterableDropdown;

    public array $filterableContracts = [];
    public int $contract_id = 0;

    protected ?User $manager;
    protected bool $revalidateTable = false;
    protected string $paginationTheme = 'paginator-buttons';

    protected $queryString = [
        'contract_id'
    ];

    public function boot()
    {
        $this->manager = auth()->user();
    }

    public function mount()
    {
        $this->initFilterable();

        if (array_key_exists($this->contract_id, $this->filterableContracts['list'])) {
            $this->filterableContracts['id'] = $this->contract_id;
            $this->filterableContracts['value'] = $this->filterableContracts['list'][$this->contract_id];
        }
    }

    public function render()
    {
        if ($this->revalidateTable) {
            $this->dispatchBrowserEvent('updateFooData');
        }

        $orders = $this->revalidateOrders();
        $debt = $this->revalidateDebt();

        $table = view(
            'livewire.manager.debts.show-footable-render',
            compact('orders')
        )->render();

        return view('livewire.manager.debts.show-page-main-livewire', [
            'table' => $table,
            'orders' => $orders,
            'debt' => $debt,
            'filterableMode' => $this->filterableMode,
        ]);
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->revalidateTable = true;
    }

    protected function onSetFilterableContracts($id, $name)
    {
        $this->contract_id = $id;
        $this->revalidateTable = true;
    }

    public function revalidateOrders(): LengthAwarePaginator
    {
        $query = Order::query()
            ->with(['contract', 'paymentType.translation'])
            ->where('debt_sum', '>', 0)
            ->whereRelation('contract', 'id', '=', $this->contract_id);

        return $query->paginate($this->getPerPageValue());
    }

    public function revalidateDebt()
    {
        return ContractDebt::query()
            ->where('contract_id', $this->contract_id)
            ->firstOrNew();
    }

    public function unloadBalance()
    {
        $this->dispatchBrowserEvent('flashMessage', [
            'title' => __('custom::site.unload_balance'),
            'message' => 'not programmed, need 1C endpoint',
            'state' => 'warning'
        ]);
    }

    public function uploadReconciliationActs()
    {
        $this->dispatchBrowserEvent('flashMessage', [
            'title' => __('custom::site.reconciliation_act'),
            'message' => 'not programmed, need 1C endpoint',
            'state' => 'warning'
        ]);
    }

    protected function setFilterableContractsList($value): array
    {
        $sub = $this->manager->customers()->select('id')->toRawSql();
        return Contract::query()
            ->with('counterparty:name,id')
            ->whereHas('customers', fn($q) => $q->whereInRaw('customer_id', $sub))
            ->select('registry_no', 'id', 'counterparty_id')
            ->get()->keyBy('id')
            ->map(fn($el) => "{$el->registry_no} -- {$el->counterparty->name}")
            ->toArray();
    }
}
