<?php

namespace App\Http\Livewire\Manager\Debts;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Contract;
use App\Models\Counterparty;
use App\Models\Debt;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPageMainLivewire extends Component
{
    use WithPagination;
    use WithPerPage;
    use WithFilterableDropdown;

    public int $counterparty_id = 0;

    public array $filterableCounterparty = [];
    public array $filterableCustomer = [];
    public array $filterableSearch = [];

    public string $sortable = '';
    public string $sortable_id = '';
    public array $sortable_list = [];
    public bool $sortableDesc = false;

    public ?Debt $receivable = null;

    protected ?User $manager;
    protected bool $revalidateTable = false;
    protected string $paginationTheme = 'paginator-buttons';

    protected $queryString = [
        'counterparty_id' => ['except' => 0],
    ];

    public function boot()
    {
        $this->manager = auth()->user();
    }

    public function mount(Request $request)
    {
        $this->initFilterable();

        // обновляем список столбцов сортировки
        $this->sortable_list = [
            'counterparty' => __('custom::site.counterparty'),
            'contract' => __('custom::site.contract'),
            'limit_sum' => __('custom::site.credit_limit'),
            'limit_days' => __('custom::site.postponement_days'),
            'debt_sum' => __('custom::site.total'),
            'expected_sum' => __('custom::site.expected'),
        ];

        $this->receivable = $this->manager->receivable;

        $this->initCounterpartyItem();

    }

    public function render()
    {
        if ($this->revalidateTable) {
            $this->dispatchBrowserEvent('updateFooData');
        }

        $contracts = $this->revalidateContracts();

        $table = view(
            'livewire.manager.debts.index-footable-render',
            compact('contracts')
        )->render();

        return view(
            'livewire.manager.debts.index-page-main-livewire',
            [
                'table' => $table,
                'contracts' => $contracts,
                'filterableMode' => $this->filterableMode,
            ]
        );
    }

    public function updated($field, $value)
    {
        $this->updatedFilterable($field, $value);
    }

    public function updatedSortableId($value)
    {
        $this->revalidateTable = true;
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->revalidateTable = true;
    }

    protected function onUpdatingFilterableSearchValue($value)
    {
        $this->onSetFilterable('filterableSearch', null, null);
        $this->revalidateTable = true;
    }

    protected function onSetFilterable($prop, $id, $name)
    {
        // сбрасываем все свойства кроме текущего $prop
        foreach (array_keys($this->getFilterableProps()) as $propName) {
            if ($prop !== $propName) {
                $this->resetFilterable($propName);
            }
        }
        $this->revalidateTable = true;
    }

    protected function onSetFilterableCounterparty($id){
        $this->counterparty_id = $id;
    }

    protected function onResetFilterable($prop)
    {
        if ('filterableCounterparty' === $prop){
            $this->counterparty_id = 0;
        }

        $this->revalidateTable = true;
    }

    protected function revalidateContracts(): LengthAwarePaginator
    {
        $sub = $this->manager->customers()->select('id')->toRawSql();
        $query = Contract::query()
            ->with('counterparty')
            ->join('contract_debts as cd', 'cd.contract_id', '=', 'contracts.id')
            ->whereHas('customers', fn($q1) => $q1->whereIn('id', [DB::Raw($sub)]));

        if ($this->filterableCounterparty['id']) {
            $query->whereRelation('counterparty', 'id', '=', $this->filterableCounterparty['id']);
        }

        if ($this->filterableCustomer['id']) {
            $query->whereRelation('customers', 'id', '=', $this->filterableCustomer['id']);
        }

        if ($value = trim($this->filterableSearch['value'])) {
            $query->where(function ($q) use ($value) {
                $q
                    ->where('registry_no', 'like', "%{$value}%")
                    ->orWhereHas('counterparty', function ($q) use ($value) {
                        $q->where('name', 'like', "%{$value}%");
                        if($digits = preg_replace('/[^\d%]/', '', $value)) {
                            $q->orWhere('okpo', 'like', "%{$digits}%")
                                ->orWhere('phone', 'like', "%{$digits}%");
                        }
                    })
                    ->orWhereHas('debt', function ($q) use ($value) {
                        if($digits = preg_replace('/[^\d%]/', '', $value)) {
                            $q->where('limit_sum', $digits)
                                ->orWhere('limit_days', $digits)
                                ->orWhere('debt_sum', $digits)
                                ->orWhere('overdue_sum', $digits)
                                ->orWhere('expected_sum', $digits);
                        }
                    });
            });
        }

        if ($this->sortable_id) {
            if (in_array($this->sortable_id, ['limit_sum', 'limit_days', 'debt_sum', 'expected_sum'] )){
                $query->orderBy($this->sortable_id, $this->getSortOrder());
            }
            if ('contract' === $this->sortable_id){
                $query->orderBy('registry_no', $this->getSortOrder());
            }
            if ('counterparty' === $this->sortable_id){
                $sub = Counterparty::query()->select('id', 'name as counterparty_name');
                $table = $query->getModel()->getTable();
                $query
                    ->joinSub($sub, 'pty', fn($join) => $join->on("$table.counterparty_id", '=', 'pty.id'))
                    ->orderBy('counterparty_name', $this->getSortOrder());
            }
        }

        return $query->paginate($this->getPerPageValue());
    }

    public function unloadBalance()
    {
        $this->dispatchBrowserEvent('flashMessage', [
            'title' => __('custom::site.unload_balance'),
            'message' => 'not programmed',
            'state' => 'warning'
        ]);
    }

//    public function paymentSchedule()
//    {
//        $this->dispatchBrowserEvent('flashMessage', [
//            'title' => __('custom::site.payment_schedule'),
//            'message' => 'not programmed',
//            'state' => 'warning'
//        ]);
//    }
//
    protected function getSortOrder(): string
    {
        return ($this->sortableDesc = !$this->sortableDesc)
            ? 'DESC'
            : 'ASC';
    }

    protected function debtorCustomersQuery(): Builder
    {
        return $this->manager->customers()
            ->whereHas('contracts.debt');
    }

    protected function setFilterableCounterpartyList($value): array
    {
        $sub = $this->debtorCustomersQuery()->select('id')->toRawSql();
        return $value
            ? Counterparty::query()
                ->select('id', 'name')
                ->where('name', 'like', "%{$value}%")
                ->orWhereDigitFieldLike('phone', "%{$value}%")
                ->whereHas('users', fn($q) => $q->whereInRaw('users.id', $sub))
                ->take(10)->get()
                ->keyBy('id')->map->name
                ->toArray()
            : [];
    }

    protected function setFilterableCustomerList($value): array
    {
        return $value
            ? $this->debtorCustomersQuery()
                ->withTranslation()
                ->where(fn($q) => $q->whereTranslationLike('name', "%{$value}%")
                    ->orWhereDigitFieldLike('phone', "%{$value}%")
                    ->orWhere('position', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%")
                )
                ->take(10)->get('id')
                ->keyBy('id')->map->name
                ->toArray()

            : [];
    }

    protected function initCounterpartyItem(){
        if ($this->counterparty_id
            && $name = Counterparty::where('id', $this->counterparty_id)->value('name')){
            $this->filterableCounterparty['id'] = $this->counterparty_id;
            $this->filterableCounterparty['value'] = $name;
        }
    }
}
