<?php

namespace App\Http\Livewire\Manager\Orders;

use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Counterparty;
use App\Models\Order;
use App\Models\OrderStatusType;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPageMainLivewire extends Component
{
    use WithPagination;
    use WithPerPage;

    public array $filterableOrderId;
    public array $filterableArticle;
    public array $filterableCounterparty;
    public array $filterableProductName;
    public array $filterableCustomer;
    public array $filterableSearch;

    public string $dateFrom = '';
    public string $dateTo = '';

    public array $statusList;
    public int $statusId = 0;
    public int $count_all = 0;
    public int $customerId = 0;

    protected ?User $manager;
    protected bool $revalidateTable = true;
    protected string $paginationTheme = 'paginator-buttons';

    protected $queryString = [
        'customerId' => ['except' => 0],
    ];

    protected $listeners = [
        'eventDeleteOrder',
        'eventOrderReplicate',
    ];

    public function boot()
    {
        $this->manager = auth()->user();
    }

    public function mount()
    {
        $this->initFilterables();
        $this->initStatusList();

        if ($this->customerId && $customer = User::find($this->customerId)) {
            $this->filterableCustomer['id'] = $this->customerId;
            $this->filterableCustomer['value'] = $customer->name;
            $this->customerId = 0;
        }
    }

    public function render()
    {
        if ($this->revalidateTable) {
            $this->dispatchBrowserEvent('updateFooData');
        }

        $orders = $this->revalidateData();

        $table = view('livewire.manager.orders.index-footable-render', [
            'orders' => $orders,
        ])->render();

        return view(
            'livewire.manager.orders.index-page-main-livewire',
            compact('orders', 'table')
        );
    }

    public function updatingDateFrom($value)
    {
        if (empty($value)) {
            $this->skipRender();
        }
    }

    public function updatedDateFrom($value)
    {
        if (empty($value)) {
            $this->dateTo = '';
        }
    }

    public function updated($field, $value)
    {
        if (false !== strpos($field, 'filterable')) {
            $key = str_replace(['filterable', '.value'], '', $field);
            $this->closeFilterables();
            $this->updatedFilterableValue($key, $value);
            $this->revalidateTable = false;
        }
    }

    public function resetFilterable($key)
    {
        if (property_exists($this, $key)) {
            $this->{$key} = $this->makeFilterableTemplate();
        }
    }

    public function setFilterable($key, $id, $name)
    {
        if (in_array($key, ['filterableCustomer', 'filterableSearch'])) {
            $this->resetAllFilters();
        }

        if (property_exists($this, $key)) {
            $item = $this->{$key};
            $item['id'] = $id;
            $item['value'] = $name;
            $item['edit'] = false;
            $this->{$key} = $item;

            $this->resetPage();
        }
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->closeFilterables();
    }

    public function setStatusId($id)
    {
        $this->statusId = $id;
    }

    public function closeFilterables()
    {
        $this->filterableOrderId['edit'] = false;
        $this->filterableArticle['edit'] = false;
        $this->filterableCounterparty['edit'] = false;
        $this->filterableProductName['edit'] = false;
        $this->filterableCustomer['edit'] = false;
        $this->filterableSearch['edit'] = false;
    }

    public function resetAllFilters()
    {
        $this->dateFrom = $this->dateTo = '';
        $this->initFilterables();
        $this->resetPage();
        $this->statusId = 0;
        $this->customerId = 0;

        $this->dispatchBrowserEvent('eventResetDateInterval');
    }

    public function eventOrderReplicate($id)
    {
        if (orders()->replicateOrder($id)) {
            $this->dispatchBrowserEvent('flashMessage',
                [
                    'title' => __('custom::site.message'),
                    'message' => __('custom::site.order_replicate_success'),
                    'state' => 'success'
                ]
            );
            $this->initStatusList();
        }
    }

    public function eventDeleteOrder($id)
    {
        Order::query()->whereId($id)->delete();
        $this->dispatchBrowserEvent('flashMessage',
            [
                'title' => __('custom::site.message'),
                'message' => __('custom::site.order_delete_success'),
                'state' => 'success'
            ]
        );
        $this->initStatusList();
    }

    public function isNotDirector(): bool
    {
        return !$this->manager->isDirector;
    }

    /** Service Functions */

    protected function revalidateData(): LengthAwarePaginator
    {
        return $this->ordersQuery()->paginate($this->getPerPageValue());
    }

    /** Служебные функции */

    private function getCustomerIds()
    {
        static $ids;
        if (!$ids) {
            $ids = $this->manager->customers()->pluck('id');
        }
        return $ids;
    }

    private function ordersQuery()
    {
        $customerIds = $this->getCustomerIds();
        $query = Order::query()
            ->whereIn('customer_id', $customerIds)
            ->with(
                'products',
                'paymentType.translations',
                'customer',
                'deliveryAddress.deliveryType.translations',
                'contract.counterparty',
                'status.translations'
            )
            ->orderBy('id', 'desc');

        if ($this->filterableOrderId['id']) {
            $query->where('id', $this->filterableOrderId['id']);
        }

        if ($this->filterableArticle['id']) {
            $query->whereProductId($this->filterableArticle['id']);
        }
        if ($this->filterableProductName['id']) {
            $query->whereProductId($this->filterableProductName['id']);
        }

        if ($this->filterableCounterparty['id']) {
            $query->whereCounterpartyId($this->filterableCounterparty['id']);
        }

        if ($this->filterableCustomer['id']) {
            $query->whereCustomerId($this->filterableCustomer['id']);
        }

        if ($this->filterableSearch['id']) {
            $query->whereId($this->filterableSearch['id']);
        }

        if ($this->dateFrom) {
            $query->whereDateFrom($this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDateTo($this->dateTo);
        }

        if ($this->statusId) {
            $query->where('status_id', $this->statusId);
        }

        return $query;
    }

    private function initStatusList()
    {
        $fixed = [
            OrderStatusType::STATUS_NEW => __('custom::site.order_status_new'),
            OrderStatusType::STATUS_PROCESSING => __('custom::site.order_status_processing'),
            OrderStatusType::STATUS_ASSEMBLY => __('custom::site.order_status_assembly'),
            OrderStatusType::STATUS_SHIPPING => __('custom::site.order_status_shipping'),
            OrderStatusType::STATUS_COMPLETED => __('custom::site.order_status_completed'),
            OrderStatusType::STATUS_CANCELED => __('custom::site.order_status_canceled'),
            OrderStatusType::STATUS_EDITED => __('custom::site.order_status_edited'),
        ];

        $fixedIds = array_keys($fixed);

        $ids = $this->getCustomerIds();

        $list = OrderStatusType::query()
            ->whereIn('id', $fixedIds)
            ->withCount(['orders as ordersCount' => fn($q) => $q->whereIn('customer_id', $ids)])
            ->get()
            ->each(fn($s) => $s->name = $fixed[$s->id])
            ->keyBy('id');

        $this->count_all = $list->sum('ordersCount');

        $this->statusList = $list->toArray();
    }

    private function initFilterables()
    {
        $this->filterableOrderId = $this->makeFilterableTemplate();
        $this->filterableArticle = $this->makeFilterableTemplate();
        $this->filterableCounterparty = $this->makeFilterableTemplate();
        $this->filterableProductName = $this->makeFilterableTemplate();
        $this->filterableCustomer = $this->makeFilterableTemplate();
        $this->filterableSearch = $this->makeFilterableTemplate();
    }

    private function makeFilterableTemplate(): array
    {
        return [
            'value' => '',
            'id' => 0,
            'list' => [],
            'edit' => false,
        ];
    }

    private function updatedFilterableValue($key, $value)
    {
        $value = trim($value);
        $prop = 'filterable' . $key;
        if ($value && property_exists($this, $prop)) {
            $method = "set{$key}List";
            $item = $this->{$prop};
            $item['id'] = 0;
            $item['name'] = $value;
            $item['list'] = $this->{$method}($value);
            $item['edit'] = !empty($item['list']);
            $this->{$prop} = $item;
        }
    }

    private function setOrderIdList($value): array
    {
        if ($value) {
            return $this->ordersQuery()
                ->where('id', 'like', "%{$value}%")
                ->take(10)->pluck('id', 'id')->toArray();
        }
        return [];
    }

    private function setArticleList($value): array
    {
        if ($value) {
            $ids = $this->ordersQuery()->pluck('id');
            return Product::query()
                ->whereHas('orders', fn($q) => $q->whereIn('id', $ids))
                ->where('articul', 'like', "%{$value}%")
                ->take(10)->pluck('articul', 'id')->toArray();
        }
        return [];
    }

    private function setCounterpartyList($value): array
    {
        if ($value) {
            $ids = $this->ordersQuery()->pluck('id');
            return Counterparty::query()
                ->whereHas('contracts.orders', fn($q) => $q->whereIn('id', $ids))
                ->where('name', 'like', "%{$value}%")
                ->take(10)->pluck('name', 'id')->toArray();
        }
        return [];
    }

    private function setProductNameList($value): array
    {
        if ($value) {
            $ids = $this->ordersQuery()->pluck('id');
            return Product::query()
                ->whereHas('orders', fn($q) => $q->whereIn('id', $ids))
                ->whereTranslationLike('name', "%{$value}%")
                ->take(10)->select('id')->get()
                ->keyBy('id')->map->name->toArray();
        }
        return [];
    }

    private function setCustomerList($value): array
    {
        if ($value) {
            return $this->manager->customers()
                ->withTranslation()
                ->whereHas('orders')
                ->where(function ($q) use ($value) {
                    $q->whereTranslationLike('name', "%{$value}%");
                    $q->orWhereDigitFieldLike('phone', "%{$value}%");
                })
                ->take(10)->select('id')->get()
                ->keyBy('id')->map->name->toArray();
        }
        return [];
    }

    private function setSearchList($value): array
    {
        if ($value) {
            $customerIds = $this->getCustomerIds();
            return Order::query()
                ->whereIn('customer_id', $customerIds)
                ->with(['products', 'paymentType.translations', 'customer'])
                ->where(function ($q) use ($value) {
                    $q->where('id', 'like', "%{$value}%")
                        ->orWhere('ttn', 'like', "%{$value}%")
                        ->orWhere('comment', 'like', "%{$value}%")
                        ->orWhereHas('status', function ($q) use ($value) {
                            $q->whereTranslationLike('name', "%{$value}%");
                        })
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
                        ->orWhereHas('deliveryAddress', function ($q) use ($value) {
                            $q->where('address_full', 'like', "%{$value}%");
                            $q->orWhere('city_name', 'like', "%{$value}%");
                            $q->orWhere('street_name', 'like', "%{$value}%");
                            $q->orWhereHas('deliveryType', function ($q) use ($value) {
                                $q->whereTranslationLike('name', "%{$value}%");
                            });
                            $q->orWhereHas('city', function ($q) use ($value) {
                                $q->where('name_uk', 'like', "%{$value}%");
                            });
                        });
                    if ($date = strtotime($value)) {
                        $q->orWhereDate('created_at', date('Y-m-d', $date));
                    }
                    if ($sum = round(floatval(str_replace(',', '.', $value)), 2)) {
                        // find by part of float field "total"
                        $q->orWhereRaw(DB::Raw("CONVERT(Round(total,2), CHAR) LIKE '%$sum%'"));
                    }
                })
                ->withCount('products')
                ->take(10)->get()
                ->each(function ($el) {
                    $el->name = sprintf(
                        '#%s %s, %d %s',
                        $el->id,
                        $el->created_at->format('d-m-Y'),
                        $el->products_count,
                        numericCasesLang($el->products_count,'custom::site.product')
                    );
                })
                ->keyBy('id')->map->name->toArray();
        }

        return [];
    }
}
