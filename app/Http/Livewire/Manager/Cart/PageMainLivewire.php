<?php

namespace App\Http\Livewire\Manager\Cart;

use App\Models\Contract;
use App\Models\CustomerRecipient;
use App\Models\DeliveryAddress;
use App\Models\OrderStatusType;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\User;
use App\Services\OrdersService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PageMainLivewire extends Component
{
    public ?User $customer = null;
    public ?Contract $contract = null;
    public ?PaymentType $paymentType = null;

    public int $customerId = 0;
    public bool $callback_off = false;

    public float $cashbackAvailable = 0;
    public float $cashbackToUse = 0;
    public float $cashbackUsed = 0;

    protected $queryString = [
        'customerId' => ['except' => 0],
    ];

    protected $listeners = [
        'eventCreateOrder',
        'eventSetOrderCustomer',
        'eventSetOrderContract',
        'eventSetOrderPaymentType',
    ];

    public function mount()
    {
        $this->customer = User::find($this->customerId);

        $this->revalidateCashbackAvailable();
    }

    public function render()
    {
        $products = $this->prepareProducts();
        $products->load('images', 'translation');

        $this->dispatchBrowserEvent('updatePageMainValues', [
            'products' => $products->keyBy('cartUuid')
                ->map(function (Product $p) {
                    return [
                        'cartCost' => formatMoney($p->cartCost),
                        'price' => formatMoney($p->cartPrice),
                        'checked' => $p->cartChecked,
                    ];
                })
        ]);

        $checked = $products->filter->cartChecked;

        $totals = [
            'cartCheckedQty' => $checked->map->cartQuantity->sum(),
            'cartCheckedCost' => $checked->map->cartCost->sum() - $this->cashbackUsed,
            'weight' => $checked->map(fn($el) => $el->weight * $el->cartQuantity)->sum(),
            'volume' => $checked->map(fn($el) => $el->volume * $el->cartQuantity)->sum(),
        ];

        return view('livewire.manager.cart.page-main-livewire', [
            'products' => $products,
            'totals' => $totals,
        ]);
    }

    public function prepareProducts(bool $onlyChecked = false)
    {
        $products = $onlyChecked
            ? cart()->checkedProducts()
            : cart()->products();

        return $products
            ->each(function (Product $p) {
                $p->cartPrice = $p
                    ->forCustomer($this->customer)
                    ->forContract($this->contract)
                    ->forPaymentType($this->paymentType)
                    ->price;
                $p->cartCost = $p->cartQuantity * $p->cartPrice;
            });
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
    }

    public function removeProduct($uuid)
    {
        cart()->removeProducts($uuid);
        $this->recalculateCashbackToUse();
        $this->emit('eventCartChanged');
    }

    public function setCheckProduct($uuid, $checked)
    {
        cart()->checkProducts($uuid, $checked);
        $this->recalculateCashbackToUse();
    }

    public function updateProductQuantity($product_id, $quantity)
    {
        cart()->setQuantity($product_id, $quantity);
        $this->recalculateCashbackToUse();
        $this->emit('eventCartChanged');
    }

    public function writeOffCashback()
    {
        $this->updatedCashbackToUse($this->cashbackToUse);
        $this->cashbackUsed = $this->cashbackToUse;
    }

    /** События */

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

        try {
            DB::beginTransaction();

            $paymentType = PaymentType::find($payload['paymentTypeId']);

            if (!$payload['recipientId'] && $payload['recipientName']) {
                $recipient = CustomerRecipient::create([
                    'customer_id' => $this->customer->id,
                    'name' => $payload['recipientName'],
                    'recipient' => $payload['recipientINN'],
                ]);
                $payload['recipientId'] = $recipient->id;
            }

            if (!$payload['deliveryId']) {
                $delivery = new DeliveryAddress();
                $delivery->fill($payload['deliveryData']);
                if ($payload['contractId']
                    && $contract = Contract::find($payload['contractId'])) {
                    $delivery->owner()->associate($contract);
                } else {
                    $delivery->owner()->associate($this->customer);
                }
                $delivery->save();
                $payload['deliveryId'] = $delivery->id;
            }

            $order = orders()->createOrderFromCart($this->customer, $this->cashbackUsed);

            $order->payment_type_id = $payload['paymentTypeId'] ?: null;
            $order->contract_id = $payload['contractId'] ?: null;
            $order->type_payment = $paymentType->code ?? null;
            $order->recipient_id = $payload['recipientId'] ?: null;
            $order->delivery_address_id = $payload['deliveryId'];
            $order->callback_off = $this->callback_off;
            $order->cashback_used = $this->cashbackUsed;
            $order->comment = $payload['comment'];
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

            // Todo: наладить списание кэшбека
//            if ($this->cashbackUsed) {
//                cashback()->expenseCashback($this->customer, $this->cashbackUsed);
//            }

            if ('draft' === $payload['status']){
                $orderService = app()->make(OrdersService::class);
                $orderService->setOrderEdited($order->id);
            }

            DB::commit();
            $this->redirect(route('manager.orders.index'));
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

    public function eventSetOrderCustomer($id)
    {
        if ($customer = User::find($id)) {
            $this->customerId = $id;
            $this->customer = $customer;
        } else {
            $this->customerId = 0;
            $this->customer = auth()->user();
        }

        $this->revalidateCashbackAvailable();
    }

    public function eventSetOrderContract($id)
    {
        $this->contract = Contract::find((int)$id);
        $this->recalculateCashbackToUse();
    }

    public function eventSetOrderPaymentType($id)
    {
        $this->paymentType = PaymentType::find((int)$id);
        $this->recalculateCashbackToUse();
    }

    /** Service Functions */

    protected function revalidateCashbackAvailable()
    {
        $this->cashbackAvailable = cashback()->getCashbackAvailable($this->customer);
        $this->recalculateCashbackToUse();
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

}
