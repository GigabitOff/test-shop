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
        'eventTest',
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

    public function changeProductQuantity($uuid, $quantity,$max)
    {

        if($max !== null AND $quantity > $max)
        $quantity = $max;

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

        if (empty($payload['deliveryId'])) {
            $last_delivery_address_id = DB::table('delivery_addresses')
                ->orderBy('id', 'desc')
                ->value('id');
            $payload['deliveryId'] = $last_delivery_address_id;
        }

        $delivery = new DeliveryAddress();
        $delivery->fill($payload['deliveryData']);

        $delivery->save();
     

        $recipientData = [
            'customer_id' => $this->customer->id,
            'delivery_address_id' => $delivery->id,
        ];
        if (isset($payload['phone'])) {
            $recipientData['phone'] = $payload['phone'];
        }
        if (isset($payload['recipientName'])) {
            $recipientData['name'] = $payload['recipientName'];
        }
        if (isset($payload['recipientINN'])) {
            $recipientData['inn'] = $payload['recipientINN'];
        }
        if (isset($payload['recipientFIO'])) {
            $recipientData['fop_title'] = $payload['recipientFIO'];
        }

        $recipient = CustomerRecipient::create($recipientData);

        $payload['recipientId'] = $recipient->id;

        $this->prepareProducts(true, true);
        $order = orders()->createOrderFromCart($this->customer, $this->cashbackUsed);
        $recipientID =  $payload['recipientId'];
        $order->payment_type_id = $payload['paymentTypeId'];
        $order->type_payment = $paymentType->code ?? null;
        $order->delivery_address_id = $delivery->id;
        $order->recipient_id = $recipientID;
        $order->callback_off = $this->callback_off;
        $order->cashback_used = $this->cashbackUsed;
        $order->comment = $payload['comment'];
        $order->phone = $payload['phone'];
        $order->manager_id = $this->customer->manager_id;
        $order->status_id = $this->callback_off
            ? OrderStatusType::STATUS_PROCESSING
            : OrderStatusType::STATUS_NEW;
        if ($order->payment_type_id === PaymentType::POSTPAID
            && $receivable = $this->customer->receivable) {
            $order->debt_sum = $payload['postpaidSum'];
            $order->debt_end_at = Carbon::now()->addDays($receivable->otsrochka_days);
        }
        $order->save();
        DB::commit();
        $this->dispatchBrowserEvent('flashMessage', [
            'title' => __('custom::site.order'),
            'message' => __('custom::site.order_save_amount_verify'),
            'state' => 'success'
        ]);

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
            $this->emit('eventRefreshPage');
   
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

    public function updateCartDeletedata()
    {
        $ids = cart()->checkedProductIds()->all();

        DB::table('cart_product')
            ->whereIn('product_id', $ids)
            ->update(['checked' => 0]);

        DB::table('cart_product')
            ->whereIn('product_id', $ids)
            ->delete();
    }

    public function eventRefreshPage()
    {
        $this->dispatchBrowserEvent('updateFooData');
    }

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
