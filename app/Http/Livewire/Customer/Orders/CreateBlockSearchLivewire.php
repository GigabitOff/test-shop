<?php

namespace App\Http\Livewire\Customer\Orders;

use App\Http\Livewire\Traits\WithFilterableDrop;
use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CreateBlockSearchLivewire extends Component
{
    use WithPagination;
    use WithPerPage;
    use WithFilterableDrop;

    const RANK_VIEW_ALL = 'all';
    const RANK_VIEW_NOVELTY = 'novelty';
    const RANK_VIEW_MARKDOWN = 'markdown';

    public string $filterableBrand = '';
    public string $filterableSort = '';
    public string $filterableSearch = '';
    public string $filterableRankView = '';

    public string $selectedRankView = self::RANK_VIEW_ALL;
    public int $totalNovelty = 0;
    public int $totalMarkdown = 0;

    public array $perPageListItems = [5, 10, 20, 30, 40];
    protected string $paginationTheme = 'paginator-cabinet';

    protected $listeners = [
        'eventBulkOrderProductsUploaded',
    ];

    public function render()
    {
        $this->calculateTotals();
        $products = $this->extractProducts();
        $table = view('livewire.customer.orders.create-footable-render', [
            'products' => $products,
        ])->render();
        $this->dispatchBrowserEvent('updateFooData');
        return view('livewire.customer.orders.create-block-search-livewire', [
            'products' => $products,
            'table' => $table,
        ]);
    }

    public function eventBulkOrderProductsUploaded()
    {
        // Just revalidate. Do not delete this method.
    }

    public function selectRankView($rank)
    {
        $this->selectedRankView = $rank;
    }

    /** Служебные функции */

    private function calculateTotals()
    {
        $this->totalNovelty = $this->searchQuery(false)->onlyNovelty()->count();
        $this->totalMarkdown = $this->searchQuery(false)->onlyMarkdown()->count();
        $this->resetFilterable('filterableRankView');
    }

    private function extractProducts(): LengthAwarePaginator
    {
        $query = $this->searchQuery()
            ->with(['images', 'translation', 'categories']);

        $products = $query->paginate($this->getPerPageValue());

        // Расширяем свойства товара для нужд представления.
        $products->getCollection()
            ->tap(fn($c) => $this->applyReserveCounters($c))
            ->tap(fn($c) => $this->applyInOrderCounters($c))
            ->each(function ($product) {
                $this->expandWithCartQuantity($product);
                $this->expandWithAvailability($product);
            });

        return $products;
    }

    private function searchQuery(bool $applyRankView = true): Builder
    {
        $value = trim(trim($this->filterableSearch));
        return Product::query()
            ->when($this->filterableBrandId, fn($q) => $this->applyBrandFiltering($q))
            ->when($value, fn($q) => $this->applySearchByValue($q, $value))
            ->when($this->filterableSortId, fn($q) => $this->applySorting($q))
            ->when($applyRankView, fn($q) => $this->applyRankView($q));
    }

    protected function applyRankView(Builder $query)
    {
        switch ($this->selectedRankView) {
            case self::RANK_VIEW_NOVELTY:
                $query->onlyNovelty();
                break;
            case self::RANK_VIEW_MARKDOWN:
                $query->onlyMarkdown();
                break;
        }
    }

    protected function applyBrandFiltering(Builder $query)
    {
        $id = str_replace('#', '', $this->filterableBrandId);
        $query->whereRelation('brand', 'id', $id);
    }

    protected function applySorting(Builder $query)
    {
        switch ($this->filterableSortId) {
            case 'by_rating':
                $this->applySortRating($query);
                break;
            case 'by_price_cheap':
                $query->orderBy('price_init');
                break;
            case 'by_price_expensive':
                $query->orderByDesc('price_init');
                break;
        }
    }

    protected function applySortRating(Builder $query)
    {
        $sub = DB::table('product_visits')
            ->selectRaw('product_id as visits_product_id, sum(quantity) as visits_quantity')
            ->groupBy('product_id');
        $query->leftJoinSub($sub, 'visits', 'visits.visits_product_id', '=', 'products.id')
            ->orderByDesc('visits_quantity');
    }

    protected function applySearchByValue(Builder $query, string $value)
    {
        $query->where(function ($query) use ($value) {
            $query->whereTranslationLike('name', "%{$value}%")
                ->orWhere('articul', 'like', "%{$value}%")
                ->orWhere('articul_search', 'like', "%{$value}%")
                ->orWhere('brand_search', 'like', "%{$value}%")
                ->orWhere('barcode', 'like', "%{$value}%")
                ->orWhere('uktved', 'like', "%{$value}%")
                ->orWhereHas('brand', function ($q) use ($value) {
                    $q->whereTranslationLike('title', "%{$value}%");
                });
        });
    }

    /**
     * Собирает количество зарезервированных товаров.
     *
     * Учитывает все неоплаченные заказы текущего пользователя и его контрагентов.
     *
     * @param EloquentCollection $products
     * @return void
     */
    protected function applyReserveCounters(EloquentCollection $products)
    {
        $products
            ->load(['orderedCount' => function ($q) {
                $q->where('payment_status', Order::PAYMENT_STATUS_UNPAID);
                $q->where(function ($q1) {
                    $userId = auth()->id() ?? 0;
                    $q1->where('customer_id', $userId);
                    $q1->when($userId, function ($q2) {
                        $sub = auth()->user()->counterparties()->select('id')->toRawSql();
                        $q2->orWhereInRaw('counterparty_id', $sub);
                    });
                });
            }])
            ->each(fn($p) => $p->reservedCount = $p->orderedCount);
    }

    /**
     * Собирает количество заказанных товаров.
     *
     * Учитывает все оплаченные не выполненные заказы текущего пользователя и его контрагентов.
     *
     * @param EloquentCollection $products
     * @return void
     */
    protected function applyInOrderCounters(EloquentCollection $products)
    {
        $products
            ->load(['orderedCount' => function ($q) {
                $q->where('payment_status', Order::PAYMENT_STATUS_PAID);
                $q->where('status_id', '!=', Order::ORDER_COMPLETED_STATUS_ID);
                $q->where(function ($q1) {
                    $userId = auth()->id() ?? 0;
                    $q1->where('customer_id', $userId);
                    $q1->when($userId, function ($q2) {
                        $sub = auth()->user()->counterparties()->select('id')->toRawSql();
                        $q2->orWhereInRaw('counterparty_id', $sub);
                    });
                });
            }])
            ->each(fn($p) => $p->inOrderCount = $p->orderedCount);
    }

    /**
     * Добавляем параметр количества в корзине.
     *
     * @param Product $product
     * @return void
     */
    protected function expandWithCartQuantity(Product $product)
    {
        if ($inCart = cart()->products()->find($product->id)) {
            $product->cartQuantity = $inCart->cartQuantity;
        } else {
            $product->cartQuantity = 0;
        }
    }

    /**
     * Добавляем стили и навания статуса доступности.
     *
     * @param Product $product
     * @return void
     */
    protected function expandWithAvailability(Product $product)
    {
        switch (true) {
            case $product->isAvailabilityInStock():
                $product->availabilityCss = '--status-1';
                $product->availabilityText = __('custom::site.availability_exist');
                break;
            case $product->isAvailabilitySmallStock():
                $product->availabilityCss = '--status-3';
                $product->availabilityText = __('custom::site.availability_small');
                break;
            default:
                $product->availabilityCss = '--status-2';
                $product->availabilityText = __('custom::site.availability_waiting');
        }
    }

    protected function setFilterableBrandList(): array
    {
        return Brand::query()
            ->withTranslation()
            ->select('id')
            ->get()
            ->keyBy(fn($el) => "#{$el->id}")
            ->map->title
            ->sort()
            ->toArray();
    }

    protected function setFilterableSortList(): array
    {
        return [
            'by_rating' => __('custom::site.by_rating'),
            'by_price_cheap' => __('custom::site.by_price_cheap'),
            'by_price_expensive' => __('custom::site.by_price_expensive'),
        ];
    }

    protected function setFilterableRankViewList(): array
    {
        return [
            self::RANK_VIEW_ALL => [
                'label' => __('custom::site.all'),
                'quantity' => '',
            ],
            self::RANK_VIEW_NOVELTY => [
                'label' => __('custom::site.novels'),
                'quantity' => $this->totalNovelty,
            ],
            self::RANK_VIEW_MARKDOWN => [
                'label' => __('custom::site.markdown'),
                'quantity' => $this->totalMarkdown,
            ],
        ];
    }

}
