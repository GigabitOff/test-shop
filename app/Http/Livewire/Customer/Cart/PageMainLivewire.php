<?php

namespace App\Http\Livewire\Customer\Cart;

use App\Http\Livewire\OrderMetaBlocks\RecipientPhoneLivewire;
use App\Models\Contract;
use App\Models\Counterparty;
use App\Models\CustomerRecipient;
use App\Models\DeliveryAddress;
use App\Models\OrderStatusType;
use App\Models\PaymentType;
use App\Models\PersonalOffer;
use App\Models\Product;
use App\Models\User;
use App\Services\UsersService;
use App\Traits\WithExpandProduct;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Traits\WithPerPage;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Livewire\Component;

class PageMainLivewire extends Component
{
    use WithPagination;
    use WithPerPage;
    use WithExpandProduct {
        expandProductAvailability as traitExpandProductAvailability;
    }

    protected string $perPageKey = 'cartPerPageD';
    protected int $perPageD = 10;
    public bool $callback_off = false;
    public float $cashbackAvailable = 0;
    public float $cashbackToUse = 0;
    public float $cashbackUsed = 0;

    public ?PaymentType $paymentType = null;
    public ?Counterparty $counterparty = null;
    public ?Contract $contract = null;
    public bool $phoneVerifiedAttempt = false;
    protected ?Collection $productPriceUpdated = null;
    protected ?User $customer;
    protected bool $revalidateTable = false;
    protected ?Collection $products = null;
    protected string $paginationTheme = 'paginator-buttons-cart';

    protected $listeners = [
        'eventCreateOrder',
        'eventSetOrderPaymentType',
        'eventSetOrderCounterparty',
        'eventSetOrderContract',
        'eventCheckAllChanged',
        'eventRefreshPage'
    ];


    public function boot()
    {
        $this->customer = auth()->user();

        if (session()->has('perPageD'))
            $this->perPageD = session('perPageD');

    }



    public function mount()
    {
        $this->invalidateNonValidPersonalOffers();
        $this->cashbackAvailable = cashback()->getCashbackAvailable($this->customer);
        $this->recalculateCashbackToUse();
    }

    public function render()
    {
        $products = $this->prepareProducts();

        $checkedCount = $products->filter->cartChecked->count();
        $checkAll = $checkedCount && ($checkedCount === $products->count());
        $countChangedPrice = $products->filter->countChangedPrice->count();
        if ($countChangedPrice) {
            $this->productPriceUpdated = $this->productPriceUpdated($products
                ->where('countChangedPrice', 1));
        }

        $this->dispatchBrowserEvent('updateCheckAllCheckbox', ['checkAll' => $checkAll]);

        if ($this->revalidateTable) {
            $this->dispatchBrowserEvent('updateFooData');
        } else {
            $this->dispatchBrowserEvent('updateFooTableValues', [
                'products' => $products->keyBy('cartUuid')
                    ->map(function ($p) {
                        return [
                            'cartCost' => formatMoney($p->cartCost),
                            'price' => formatMoney($p->price),
                            'checked' => $p->cartChecked,
                            'hide' => $p->hide ?? false,
                        ];
                    })
            ]);
        }

        $paginate = $this->makeAttributePaginator($products, 'cartPerPageD', $this->perPageD);


        $table = view('livewire.customer.cart.products-footable-render', [
            'products' => $paginate,
            'checkAll' => $checkAll,
            'cashbackUsed' => $this->cashbackUsed,
        ])->render();

        return view('livewire.customer.cart.page-main-livewire', [
            'products' => $paginate,
            'countChangedPrice' => $countChangedPrice,
            'productPriceUpdated' => $this->productPriceUpdated,
            'checkAll' => $checkAll,
            'cashbackUsed' => $this->cashbackUsed,
            'sumPriceRetail' => $this->totalSumBySpecialPriceField($products, 'totalPriceRetail'),
            'table' => $table
        ]);
    }

    public function setPerPage($value)
    {

        session()->put('perPageD', $value);
        $this->perPageD = $value;

        $this->resetPage();
        $this->revalidateTable = true;
    }


    protected function makeAttributePaginator(Collection $data, string $pageName, int $perPageD): LengthAwarePaginator
    {

        $currentPage = Paginator::resolveCurrentPage($pageName);

        // Сheck for going beyond the pagination so as not to get to an empty page
        $lastPage = max((int)ceil($data->count() / $perPageD), 1);

        if ($currentPage > $lastPage) {
            $currentPage = $lastPage;
            $this->setPage($lastPage, $pageName);
        }

        $slice = $data->slice($perPageD * ($currentPage - 1), $perPageD);

        return new LengthAwarePaginator($slice, $data->count(), $perPageD, $currentPage, ['pageName' => $pageName]);
    }

    public function updatedPaginators()
    {
        $this->revalidateTable = true;
    }

    /** Return total sum by fields */

    protected function totalSumBySpecialPriceField($products, $field)
    {

        return $products->where('cartChecked', 1)->sum($field);
    }

    public function prepareProducts(bool $onlyChecked = false, bool $force = false)
    {
        if (!$this->products || $force) {
            $products = cart()->products();
            $products->load('images', 'translation', 'categories.images');

            $this->products = $products
                ->each(function (Product $product) {
                    $this->expandProductPrice($product);
                    $this->expandProductOffer($product);
                    $this->expandProductAvailability($product);
                });
        }

        // отключаем товары, которые не являются Персональным предложением, для выбранного КА
        if ($this->counterparty) {
            $this->products
                ->filter->cartChecked
                ->filter->hide
                ->each(function (Product $product) {
                    cart()->checkProducts($product->cartUuid, false);
                    $product->cartChecked = false;
                });
        }

        return $onlyChecked
            ? $this->products->filter->cartChecked
            : $this->products;
    }

    protected function expandProductAvailability(Product $product)
    {
        $this->traitExpandProductAvailability($product);

        switch ($product->availabilityCss) {
            case 'not':
                $product->availabilityCss = '--status-6';
                break;
            case 'for-order':
                $product->availabilityCss = '--status-3';
                break;
            default:
                $product->availabilityCss = '--status-1';
        }
    }

    protected function expandProductPrice(Product $product)
    {
        $product->cartPrice = $product->price;
        $product->cartCost = $product->cartQuantity * $product->cartPrice;
        $product->totalPriceRetail = $product->price_rrc * $product->cartQuantity;
        if ($product->price != $product->cartPriceAdded) {
            $product->countChangedPrice = 1;
            cart()->setPriceAdded($product->id, $product->price);
        }
    }

    protected function expandProductOffer(Product $product)
    {
        $offer = $product->getPersonalOffer();
        if ($offer) {
            $offer->counterparties = $offer->counterparties()
                ->whereRelation('users', 'id', '=', $this->customer->id)
                ->get();
            $ids = $offer->counterparties->pluck('id');
            $offer->hide = $this->counterparty && $ids->isNotEmpty() && !$ids->contains($this->counterparty->id);
            $product->hide = $offer->hide;
            $product->show = !$offer->hide;
            $product->offerId = $offer->id;
            $product->offerCounterpartyNames = $offer->counterparties->pluck('name')->join(', ');
            $product->offerByUser = $offer->users()->where('id', $this->customer->id)->exists();
            $product->offerPrice = $offer->pivot->price;
            $product->offerMaxQuantity = $offer->pivot->quantity;
        }
    }

    public function updatedCashbackToUse($value)
    {
        if ($value < 0) {
            $this->cashbackToUse = 0;
        }

        $maxCashback = floor($this->calculateCashbackMaxToUse());
        if ($value > $maxCashback) {
            $this->cashbackToUse = $maxCashback;

            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.order'),
                'message' => sprintf(__('custom::site.max_cashback_to_use'), formatMoney($maxCashback, 0)),
                'state' => 'warning'
            ]);
        }
    }

    protected function productPriceUpdated($products)
    {

        return $products->map(function ($p1) {

            return [
                'slug' => $p1->slug,
                'price' => $this->roundedPrice($p1->price),
                'name' => $p1->name,
                'oldPrice' => $this->roundedPrice($p1->cartPriceAdded)
            ];
        });
    }

    /** Return an integer with 2 decimal places */

    protected function roundedPrice($price)
    {

        return number_format($price, 2);
    }

    public function checkAll($checked = false)
    {
        cart()->checkProducts(cart()->productUuids()->toArray(), $checked);
        $this->recalculateCashbackToUse();
    }

    public function clearList()
    {
        cart()->clear();
        $this->recalculateCashbackToUse();
        $this->emit('eventCartChanged');
        $this->revalidateTable = true;
    }

    public function removeProduct($uuid)
    {
        cart()->removeProducts($uuid);
        $this->recalculateCashbackToUse();
        $this->emit('eventCartChanged');
        $this->revalidateTable = true;
    }

    public function setCheckProduct($uuid, $checked)
    {
        cart()->checkProducts($uuid, $checked);
        $this->recalculateCashbackToUse();
    }

    public function changeProductQuantity($uuid, $quantity)
    {
        if ($product = cart()->getProductByUuid($uuid)) {
            $offer = $product->getPersonalOffer();
            if ($offer && $quantity > $offer->pivot->quantity) {
                $inCart = $product->cartQuantity ?? 0;
                $availableToAdd = $offer->pivot->quantity > $inCart ? $offer->pivot->quantity - $inCart : 0;

                if ($quantity > $availableToAdd) {
                    $message = sprintf(
                        __('custom::site.info_messages.personal_offer_add_to_cart_limit'),
                        $offer->pivot->quantity,
                        $inCart
                    );
                    $this->dispatchBrowserEvent('flashMessage', [
                            'title' => __('custom::site.personal_offer'),
                            'message' => $message,
                            'state' => 'warning'
                        ]
                    );
                }

                $quantity = $offer->pivot->quantity;
            }
            cart()->setQuantity($product->id, $quantity, $product->cartUniq);
            $this->recalculateCashbackToUse();
            $this->emit('eventCartChanged');
        }
        $this->revalidateTable = true;
    }

    public function writeOffCashback()
    {
        $this->updatedCashbackToUse($this->cashbackToUse);
        $this->cashbackUsed = $this->cashbackToUse;
    }

    /** События */

    public function eventCheckAllChanged(bool $checked)
    {
        cart()->checkProducts(cart()->productUuids()->toArray(), $checked);
        $this->recalculateCashbackToUse();
    }

    public function eventSetOrderPaymentType($id)
    {
        $this->paymentType = PaymentType::find((int)$id);
        $this->recalculateCashbackToUse();
    }

    public function eventSetOrderCounterparty($id)
    {
        $this->counterparty = Counterparty::find((int)$id);
    }

    public function eventSetOrderContract($id)
    {
        $this->contract = Contract::find((int)$id);
        $this->recalculateCashbackToUse();
    }

    public function eventCreateOrder($payload)
    {

        if (cart()->totalCartCheckedQuantity() < 1) {
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.order'),
                'message' => __('custom::site.choice_products_for_order'),
                'state' => 'danger'
            ]);
            return;
        }

        if ($this->isPersonalOffersNotValid()) {
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.order'),
                'message' => __('custom::site.personal_offer_any_quantity_changed'),
                'state' => 'danger'
            ]);
            $this->revalidateTable = true;
            $this->recalculateCashbackToUse();
            return;
        }

        try {
            DB::beginTransaction();
            $paymentType = PaymentType::find($payload['paymentTypeId']);

            $recipientData = [
                'customer_id' => $this->customer->id,
                'delivery_address_id' => $payload['deliveryId'],
            ];

            if ($payload['recipientName']) {
                $recipientData['name'] = $payload['recipientName'];
            }

            if ($payload['phone']) {
                $recipientData['phone'] = $payload['phone'];
            }

            if ($paymentType["id"] === 2) {
                $recipientData['inn'] = $payload['recipientINN'];
                $recipientData['fop_title'] = $payload['recipientFIO'];
            }

            $recipient = CustomerRecipient::create($recipientData);

            if (!$payload['deliveryId']) {
                $delivery = new DeliveryAddress();
                $delivery->fill($payload['deliveryData']);

                $delivery->owner()->associate($this->customer);

                $delivery->save();

                $payload['deliveryId'] = $delivery->id;
            }

            $this->prepareProducts(true, true);

            $order = orders()->createOrderFromCart($this->customer, $this->cashbackUsed);

            $order->payment_type_id = $payload['paymentTypeId'];
            $order->type_payment = $paymentType->code ?? null;
            $order->recipient_id = $recipient->id;
            $order->delivery_address_id = $payload['deliveryId'];
            $order->callback_off = $this->callback_off;
            $order->cashback_used = $this->cashbackUsed;
            $order->comment = $payload['comment'];
            $order->phone = $payload['phone'];
            $order->manager_id = $this->customer->manager_id;
            $order->status_id = $this->callback_off ? OrderStatusType::STATUS_PROCESSING : OrderStatusType::STATUS_NEW;

            if ($order->payment_type_id === PaymentType::POSTPAID && $receivable = $this->customer->receivable) {
                $order->debt_sum = $payload['postpaidSum'];
                $order->debt_end_at = Carbon::now()->addDays($receivable->otsrochka_days);
            }

            $order->save();

// Todo: наладить списание кэшбека
//if ($this->cashbackUsed) {
//    cashback()->expenseCashback($this->customer, $this->cashbackUsed);
//}

            DB::commit();

            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.order'),
                'message' => __('custom::site.order_confirmed_thanks'),
                'state' => 'success'
            ]);

            $this->recalculateCashbackToUse();
            $this->reset(['cashbackUsed', 'cashbackToUse']);
            $this->emit('eventOrderCreateSuccess');
            $this->revalidateTable = true;
            $this->prepareProducts(false, true);

        } catch (\Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . $e->getMessage());
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.order'),
                'message' => __('custom::site.order_save_fail'),
                'state' => 'danger'
            ]);
        }


    }



    public function eventRefreshPage()
    {
        $this->dispatchBrowserEvent('updateFooData');
    }

    /** Service Functions */
    protected function recalculateCashbackToUse()
    {
        $maxCashback = (int)$this->calculateCashbackMaxToUse();
        $this->cashbackToUse = $maxCashback;
        $this->cashbackUsed = $this->cashbackUsed
            ? min($this->cashbackUsed, $maxCashback)
            : 0;
    }

    protected function calculateCashbackMaxToUse()
    {
        return min(
            $this->cashbackAvailable,
            $this->prepareProducts(true)->sum->cartCost
        );
    }

    protected function isPersonalOffersNotValid(): bool
    {
        $products = cart()->products();
        $products->load('personalOffers');

        foreach ($products as $product) {
            $offerId = PersonalOffer::extractOfferIdFromUniq($product->cartUniq);
            $offer = $product->personalOffers->find($offerId);
            if ($offer && $product->cartQuantity > $offer->pivot->quantity) {
                cart()->setQuantity($product->id, $offer->quantity, $product->cartUniq);
                $status = true;
            }
        }

        return $status ?? false;
    }

    /**
     * Поиск устаревших и не валидных персональных предложений
     * Восстановление товара персонального предложения как обычного
     * @return void
     */
    protected function invalidateNonValidPersonalOffers()
    {
        $cartInvalidated = false;
        cart()->products()
            ->filter->cartUniq
            ->each(function ($product) use (&$cartInvalidated) {
                $offer = $product->getValidPersonalOffer();
                if (!$offer || $offer->pivot->quantity <= 0) {
                    cart()->addProduct($product->id, $product->cartQuantity);
                    cart()->removeProducts($product->cartUuid);
                    $cartInvalidated = true;
                }
            });

        if ($cartInvalidated) {
            session()->flash('show_message_popup', 'cart_personal_offer_invalidated');
        }
    }
}
