<?php

namespace App\Http\Livewire\Customer\Discounts;

use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Counterparty;
use App\Models\PersonalOffer;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class IndexContentLivewire extends Component
{
    use WithPagination;
    use WithPerPage;

    public float $bonusEarned = 0;
    public float $bonusUsed = 0;
    public float $bonusAvailable = 0;
    public float $cashback = 0;

    public string $bonusPopup = '';
    public array $ordersInfo = [];
    public array $perPageListItems = [5, 10, 20, 30, 40];

    protected ?User $customer;
    protected bool $revalidateTable = false;
    protected string $paginationTheme = 'paginator-cabinet';

    protected $listeners = [
        'eventAddProductToCart',
    ];

    public function boot()
    {
        $this->customer = auth()->user();
    }

    public function mount()
    {
        $this->evaluateCashback();
        $this->evaluateBonuses();
        $this->evaluateSettings();
        $this->evaluateOrdersInfo();
    }

    public function render()
    {
        //$products = $this->evaluateProductOffers();
        $products = Product::query()->paginate($this->getPerPageValue());
        $products->getCollection()->each(function ($p)  {
            $this->productExpandAvailability($p);
            $this->productExpandFirstCategory($p);
        });

        return view(
            'livewire.customer.discounts.index-content-livewire',
            compact('products')
        );
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->revalidateTable = true;
    }

    public function eventAddProductToCart($productId, $offerId, $quantity)
    {
        $offer = PersonalOffer::find($offerId);
        $productOffer = $offer
            ? $offer->products()->where('id', $productId)->first()
            : null;
        if ($productOffer) {
            $cartUniq = PersonalOffer::makeCartUniq($offerId);
            $inCart = cart()->getQuantity($productId, $cartUniq);
            $availableMax = $productOffer->pivot->quantity;
            $availableToAdd = $availableMax > $inCart ? $availableMax - $inCart : 0;

            if ($quantity > $availableToAdd) {
                $message = sprintf(
                    __('custom::site.info_messages.personal_offer_add_to_cart_limit'),
                    $availableMax,
                    $inCart
                );
                $this->dispatchBrowserEvent('flashMessage', [
                        'title' => __('custom::site.personal_offer'),
                        'message' => $message,
                        'state' => 'warning'
                    ]
                );
            }

            if ($quantity && $availableToAdd) {
                cart()->addProduct($productId, min($availableToAdd, $quantity), $cartUniq);
                $this->emit('eventCartChanged');
            }
        }
    }

    public function evaluateProductOffers()
    {
        /** @var UsersService $service */
        $service = app(UsersService::class);

        $personalOffers = $service->customerPersonalOffersQuery($this->customer)
            ->with('counterparties', function ($q) {
                $q->whereRelation('users', 'id', '=', $this->customer->id);
            })
            ->with('users', function ($q) {
                $q->where('id', $this->customer->id);
            })
            ->get();

        $products = Product::query()
            ->leftJoin('personal_offer_product as pop', 'pop.product_id', '=', 'products.id')
            ->whereIn('pop.personal_offer_id', $personalOffers->pluck('id'))
            ->where('pop.min_quantity', '>', 0)
            ->select(['*', 'pop.price as offerPrice'])
            ->with(['mainImage'])
            ->with('categories', function ($q) {
                $q->withTranslation()
                    ->with(['mainImage']);
            })
            ->withTranslation()
            ->paginate($this->getPerPageValue());

        $products->getCollection()->each(function ($p) use ($personalOffers) {
            $this->expandProduct($p, $personalOffers);
            $this->productExpandAvailability($p);
            $this->productExpandFirstCategory($p);
        });

        return $products;
    }

    protected function expandProduct(Product $product, $offers)
    {
        $offer = $offers->find($product->personal_offer_id);
        $product->offerForAll = $offer->for_all;
        $product->counterpartyNames = $offer->counterparties->map->name->join(', ');
        $product->usersCount = $offer->users->count();
    }

    /**
     * Добавляем стили и навания статуса доступности.
     *
     * @param Product $product
     * @return void
     */
    protected function productExpandAvailability(Product $product)
    {
        switch (true) {
            case $product->isAvailabilityInStock():
                $product->exAvailabilityCss = '--status-1';
                $product->exAvailabilityText = __('custom::site.availability_exist');
                break;
            case $product->isAvailabilitySmallStock():
                $product->exAvailabilityCss = '--status-3';
                $product->exAvailabilityText = __('custom::site.availability_small');
                break;
            default:
                $product->exAvailabilityCss = '--status-2';
                $product->exAvailabilityText = __('custom::site.availability_waiting');
        }
    }

    protected function productExpandFirstCategory(Product $product)
    {
        // ToDo: добавить жадную загрузку
        $product->exCategoryName = $product->categories()->first()->name ?? '';
    }


    protected function evaluateBonuses()
    {
        $sub = $this->customer->counterparties()
//            ->where('use_cashback', true)
            ->select('id')->toRawSql();

        $sums = Counterparty::query()
            ->where('is_can_bonus', true)
            ->whereInRaw('id', $sub)
            ->select([
                DB::raw('SUM(bonus_earned) as total_bonus_earned'),
                DB::raw('SUM(bonus_used) as total_bonus_used'),
            ])->first();

        $this->bonusEarned = (float)$sums->total_bonus_earned;
        $this->bonusUsed = (float)$sums->total_bonus_used;
        $this->bonusAvailable = max($this->bonusEarned - $this->bonusUsed, 0);
    }

    protected function evaluateCashback()
    {
        $this->cashback = $this->customer->counterparties()
            ->where('is_can_bonus', true)
            ->sum('cashback');
    }

    protected function evaluateSettings()
    {
        $settings = Setting::query()
            ->withTranslation()
            ->where('category', 'pop_up_fields')
            ->get();

        $this->bonusPopup = $settings
            ->firstWhere('key', 'pop_up_fields-1')->value_lang ?? '';
    }

    protected function evaluateOrdersInfo()
    {
        $this->ordersInfo = [
            'total' => $this->customer->orders()->sum('total'),
            'oldest_at' => $this->customer->orders()->min('created_at'),
            'newest_at' => $this->customer->orders()->max('created_at'),
        ];
    }

    public function isNeedRevalidateFootable(): bool
    {
        return $this->revalidateTable;
    }

}
