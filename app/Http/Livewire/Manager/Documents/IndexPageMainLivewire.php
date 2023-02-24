<?php

namespace App\Http\Livewire\Manager\Documents;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Http\Livewire\Traits\WithPerPage;
use App\Models\DeliveryType;
use App\Models\Document;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPageMainLivewire extends Component
{
    use WithPagination;
    use WithPerPage;
    use WithFilterableDropdown;

    const FILTER_ORDERS = 0;    // Заказы
    const FILTER_COMPLAINTS = 1; // Акты рекламаций
    const FILTER_REVERSES = 2;   // Возвратные накладные
    const FILTER_RECONCILIATION = 3;   // Акты сверки
    const FILTER_WAYBILLS = 4;   // Расходные накладные
    const FILTER_INVOICES = 5;   // Счета

    public array $filterableSearch = [];
    public array $filterableClient = [];

    public int $filter = self::FILTER_ORDERS;
    public int $attentions = 0;
    public bool $needsAttention = false; // состояние кнопки "Требует внимания" нажата/отжата

    protected ?User $manager;
    protected bool $redrawTable = false;
    protected bool $revalidateTable = false;
    protected string $paginationTheme = 'paginator-buttons';

    protected $queryString = [
        'filter' => ['except' => 0],
    ];

    public function boot()
    {
        $this->manager = auth()->user();
    }

    public function mount()
    {
        $this->initFilterable();
    }

    public function render()
    {
        if ($this->revalidateTable) {
            $this->dispatchBrowserEvent('updateFooData', ['filter' => $this->filter]);
        }

        if ($this->redrawTable) {
            $this->dispatchBrowserEvent('redrawFooTable', ['filter' => $this->filter]);
        }

        $records = $this->isFilterReconciliations()
            ? $this->revalidateReconciliations()
            : $this->revalidateOrders();

        $table = view($this->getRenderTableView(), [
            'records' => $records,
        ])->render();

        return view(
            'livewire.manager.documents.index-page-main-livewire',
            [
                'records' => $records,
                'table' => $table,
                'filterableMode' => $this->filterableMode,
            ]
        );
    }

    public function updated($field, $value)
    {
        $this->updatedFilterable($field, $value);
    }

    protected function getRenderTableView(): string
    {
        switch ($this->filter) {
            case self::FILTER_REVERSES:
                return 'livewire.manager.documents.reverses-footable-render';
            case self::FILTER_COMPLAINTS:
                return 'livewire.manager.documents.complaints-footable-render';
            case self::FILTER_RECONCILIATION:
                return 'livewire.manager.documents.reconciliation-footable-render';
            case self::FILTER_ORDERS:
            default:
                return 'livewire.manager.documents.index-footable-render';
        }
    }

    public function updatingFilter($value)
    {
        if ($this->filter == $value){
            $this->revalidateTable = true;
        } else {
            $this->redrawTable = true;
        }
        $this->needsAttention = false;
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->revalidateTable = true;
    }

    public function onNeedsAttention()
    {
        $this->needsAttention = !$this->needsAttention;
        $this->revalidateTable = true;
    }

    /** Service Functions */

    protected function revalidateOrders(): LengthAwarePaginator
    {
        $this->attentions = $this->searchOrdersQuery()
            ->whereHas('documents', fn($q) => $q->onlyNotApproved())
            ->count();

        $orders = $this->searchOrdersQuery()->paginate($this->getPerPageValue());

        $orders->getCollection()->each(function (Order $order) {
            $order->deliveryIcon = $order->deliveryAddress
                ? $this->deliveryIcon($order->deliveryAddress->deliveryType)
                : '';
        });

        return $orders;
    }

    private function searchOrdersQuery()
    {
        $sub = $this->manager->customers()->select('id')->toRawSql();
        $query = Order::query()
            ->whereInRaw('customer_id', $sub)
            ->whereHas('documents')
            ->with(['paymentType', 'documentWaybills'])
            ->with('deliveryAddress.deliveryType')
            ->when($this->isFilterComplaints(), function ($q) {
                $q->whereHasComplaints()
                    ->with('documentComplaints.attachments')
                    ->with('documentComplaints.products.translations')
                    ->with('documentComplaints.products.categories', fn($q) => $q->take(1));
            })
            ->when($this->isFilterReverses(), function ($q) {
                $q->whereHasReverses()
                    ->with('documentReverses.attachments')
                    ->with('documentReverses.products.translations')
                    ->with('documentReverses.products.categories', fn($q) => $q->take(1));
            })
            ->when($this->needsAttention, function ($q) {
                $q->whereHas('documents', function ($q) {
                    $q->where('type', Document::TYPE_WAYBILL)
                        ->where('status', '!=', Document::STATUS_APPROVED);
                });
            })
            ->orderBy('id', 'desc');

        if ($value = trim($this->filterableSearch['value'])) {
            $query->where(function ($q) use($value) {
                $q->where('id', 'like', "%{$value}%")
                    ->orWhereHas('products', function ($q) use ($value) {
                        $q->whereTranslationLike('name', "%{$value}%");
                    })
                    ->orWhereHas('paymentType', function ($q) use ($value) {
                        $q->whereTranslationLike('name', "%{$value}%");
                    })
                    ->orWhereHas('recipient', function ($q) use ($value) {
                        $q->where('name', 'like', "%{$value}%");
                        $q->orWhere('inn', 'like', "%{$value}%");
                    })
                    ->orWhereHas('deliveryAddress.deliveryType', function ($q) use ($value) {
                        $q->whereTranslationLike('name', "%{$value}%");
                    });
            });
        }

        if ($this->filterableClient['id']){
            $query->whereRelation('customer', 'id', '=', $this->filterableClient['id']);
        }

        return $query;
    }

    protected function revalidateReconciliations(): LengthAwarePaginator
    {
        return $this->searchReconciliationsQuery()->paginate($this->getPerPageValue());
    }

    protected function searchReconciliationsQuery(): Builder
    {
        $sub = $this->manager->customers()->select('id')->toRawSql();
        $query = Document::query()
            ->whereHas('contract.customers', fn($q) => $q->whereInRaw('id', $sub))
            ->onlyReconciliations()
            ->latest('updated_at');


        if ($value = trim($this->filterableSearch['value'])) {
            $query->where(function ($q) use ($value) {
                $q->where('id', 'like', "%{$value}%")
                    ->orWhere('registry_no', 'like', "%{$value}%")
                    ->orWhere('credit', 'like', "%{$value}%")
                    ->orWhere('debit', 'like', "%{$value}%")
                    ->orWhereHas('contract', function ($q) use ($value) {
                        $q->where('registry_no', 'like', "%{$value}%");
                    });
            });
        }

        if ($this->filterableClient['id']) {
            $query->whereRelation('contract.customers', 'id', '=', $this->filterableClient['id']);
        }

        return $query;
    }

    protected function onUpdatingFilterableSearchValue($value)
    {
        $this->revalidateTable = true;
    }

    protected function onSetFilterableClient()
    {
        $this->revalidateTable = true;
    }

    protected function onResetFilterableClient()
    {
        $this->revalidateTable = true;
    }

    protected function setFilterableClientList($value): array
    {
        return $value
            ? $this->manager->customers()
                ->withTranslation()
                ->whereHas('orders.documents')
                ->where(function ($q) use ($value) {
                    $q->whereTranslationLike('name', "%{$value}%");
                    $q->orWhereDigitFieldLike('phone', "%{$value}%");
                })
                ->take(10)->select('id')->get()
                ->keyBy('id')->map->name->toArray()
            : [];
    }

    public function deliveryIcon(DeliveryType $deliveryType): string
    {
        switch (true) {
            case $deliveryType->isNovaPoshtaService():
                return 'delivery-1.svg';
            case $deliveryType->isDeliveryAutoService():
                return 'delivery-3.svg';
            case $deliveryType->isSatService():
            case $deliveryType->isAddressDeliveryService():
            case $deliveryType->isSelfPickupService():
            default:
                return 'delivery-2.svg';
        }
    }

    public function isFilterOrders(): bool
    {
        return $this->filter === self::FILTER_ORDERS;
    }

    public function isFilterReverses(): bool
    {
        return $this->filter === self::FILTER_REVERSES;
    }

    public function isFilterComplaints(): bool
    {
        return $this->filter === self::FILTER_COMPLAINTS;
    }

    public function isFilterReconciliations(): bool
    {
        return $this->filter === self::FILTER_RECONCILIATION;
    }

    public function isFilterReversesOrComplaints(): bool
    {
        return $this->isFilterReverses() || $this->isFilterComplaints();
    }

}
