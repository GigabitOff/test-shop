<?php

namespace App\Http\Livewire\Customer\Orders;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Http\Livewire\Traits\WithProductPersonalOffer;
use App\Models\Contract;
use App\Models\Counterparty;
use App\Models\CustomerRecipient;
use App\Models\DeliveryAddress;
use App\Models\OrderEdited;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditContentLivewire extends Component
{
    use WithFilterableDropdown;
    use WithProductPersonalOffer;

    public OrderEdited $order;
    public User $customer;
    public PaymentType $paymentType;
    public ?Contract $contract = null;

    public array $filterableSearch = [];

    public bool $callback_off = false;
    public float $bonusAvailable = 0;
    public float $bonusToUse = 0;
    public float $bonusUsed = 0;
    public float $cashbackAvailable = 0;
    public float $cashbackToUse = 0;
    public float $cashbackUsed = 0;

    protected bool $redrawFootable = false;
    protected bool $revalidateFootableValues = false;

    protected $listeners = [
        'eventCreateOrder',
        'eventSetPaymentType',
        'eventSetOrderContract',
    ];

    public function mount()
    {
        $this->initFilterable();

        $this->customer = $this->order->customer;
        $this->paymentType = $this->order->paymentType;
        $this->contract = $this->order->contract;

        $this->cashbackAvailable = cashback()->getCashbackAvailable($this->customer);;
        $this->recalculateCashbackToUse();
    }

    public function render()
    {
        $products = $this->revalidateProducts();
        $products->load('images', 'translation', 'categories.images');


        if ($this->redrawFootable){
            $this->dispatchBrowserEvent('updateFooData');
        } elseif($this->revalidateFootableValues) {
            $this->dispatchBrowserEvent('updateProductTableValues', [
                'products' => $products->keyBy('orderUuid')
                    ->map(function ($p) {
                        return [
                            'orderPrice' => formatMoney($p->orderPrice),
                            'orderCost' => formatMoney($p->orderCost),
                        ];
                    })
            ]);
        }

        $totals=[
            'quantity' => $products->map->orderQuantity->sum(),
            'cost' => $products->map->orderCost->sum() - $this->cashbackUsed,
            'weight' => $products->map->orderWeight->sum(),
            'volume' => $products->map->orderVolume->sum(),
        ];

        $table = view('livewire.customer.orders.edit-footable-render', [
            'products' => $products,
            'controller' => $this,
        ])->render();

        return view('livewire.customer.orders.edit-content-livewire', [
            'table' => $table,
            'products' => $products,
            'totals' => $totals,
            'filterableMode' => $this->filterableMode,
        ]);
    }

    public function updated($field, $value)
    {
        $this->updatedFilterable($field, $value);
    }

    protected function onSetFilterable($key, $id, $name)
    {
        if ($product = Product::find($id)) {
            $this->order->products()
                ->attach($product->id, ['quantity' => 1, 'price' => $product->price]);

            $this->order->refresh();
            $this->redrawFootable = true;
        }
    }

    public function updatedCashbackToUse($value)
    {
        if ($value < 0) {
            $this->cashbackToUse = 0;
        }

        $maxCashback = floor($this->calculateCashbackMaxToUse());
        if ($value > $maxCashback) {
            $this->recalculateCashbackToUse();

            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.edit_order'),
                'message' => sprintf(__('custom::site.max_cashback_to_use'), formatMoney($maxCashback, 0)),
                'state' => 'warning'
            ]);
        } else {
            $this->cashbackToUse = (float)$value;
        }
    }

    public function clearList()
    {
        $this->order->products()->detach();
        $this->order->refresh();
        $this->recalculateCashbackToUse();
        $this->revalidateFootableValues = true;
    }

    public function removeProduct($uuid)
    {
        if ($this->order->products()->count() === 1){
            $this->dispatchBrowserEvent('flashMessage', [
                'title'=> __('custom::site.edit_order'),
                'message'=> __('custom::site.info_messages.order_delete_last_product_error'),
                'state'=> 'danger',
            ]);
            return;
        }
        $this->order->products()->wherePivot('uuid', $uuid)->detach();
        $this->order->refresh();
        $this->recalculateCashbackToUse();
        $this->redrawFootable = true;
    }

    public function changeProductQuantity($uuid, $quantity)
    {
        // Проверяем макисально доступное количество с учетом персонального предожения.
        if ($product = $this->order->products()->wherePivot('uuid', $uuid)->first()) {
            if ($this->isProductBelongValidOffer($product->pivot)) {
                $maxQuantity = $this->getOfferProductAvailableQuantity($product);
                if ($quantity > $maxQuantity) {
                    $this->dispatchBrowserEvent('flashMessage', [
                        'title' => __('custom::site.edit_order'),
                        'message' => sprintf(__('custom::site.product_max_quantity'), $maxQuantity),
                        'state' => 'warning'
                    ]);
                    $quantity = $maxQuantity;
                }
            }

            $this->order->products()->wherePivot('uuid', $uuid)
                ->updateExistingPivot($product->id, ['quantity' => (int)$quantity]);
            $this->order->refresh();
            $this->recalculateCashbackToUse();
            $this->revalidateFootableValues = true;
        }
    }

    public function writeOffCashback($value)
    {
        $this->updatedCashbackToUse($value);
        $this->cashbackUsed = $this->cashbackToUse;
    }

    public function cancelEditOrder()
    {
        if ($orig = orders()->cancelOrderEditing($this->order->order_id)){
            $this->redirectRoute('customer.orders.show', ['order' => $orig->id]);
        }
    }

    /** События */

    public function eventCreateOrder($payload)
    {
        if ($this->order->products()->count() < 1) {
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.edit_order'),
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

            $this->contract = $payload['contractId']
                ? Contract::find($payload['contractId'])
                : null;

            if (empty($payload['deliveryId'])) {
                $delivery = new DeliveryAddress();
                $delivery->fill($payload['deliveryData']);
                $delivery->owner()->associate($this->contract ?? $this->customer);
                $delivery->save();
                $payload['deliveryId'] = $delivery->id;
            }

            $orderEdited = $this->order;
            $products = $orderEdited->products
                ->each(function($p){
                    $p->orderPrice = $p->pivot->price;
                    $p->orderQuantity = $p->pivot->quantity;
                    $p->orderCost = $p->orderPrice * $p->orderQuantity;
                    $p->orderWeight = $p->weight * $p->orderQuantity;
                    $p->orderVolume = $p->volume * $p->orderQuantity;
                });

            $orderEdited->total = $products->sum->orderCost - $this->cashbackUsed;
            $orderEdited->total_quantity = $products->sum->orderQuantity;
            $orderEdited->total_weight = $products->sum->orderWeight;
            $orderEdited->total_volume = $products->sum->orderVolume;

            $orderEdited->payment_type_id = $payload['paymentTypeId'];
            $orderEdited->contract_id = $payload['contractId'] ?? null;
            $orderEdited->type_payment = $paymentType->code ?? null;
            $orderEdited->recipient_id = $payload['recipientId'];
            $orderEdited->delivery_address_id = $payload['deliveryId'];
            $orderEdited->callback_off = $this->callback_off;
            $orderEdited->cashback_used = $this->cashbackUsed;
            $orderEdited->comment = $payload['comment'];

            if ($orderEdited->payment_type_id === PaymentType::POSTPAID
                && $receivable = $this->customer->receivable){

                $orderEdited->debt_sum = $payload['postpaidSum'];
                $orderEdited->debt_end_at = Carbon::now()->addDays($receivable->otsrochka_days);
            }

            $orderEdited->save();

            $orderOriginal = orders()->updateOrderFromEdited($orderEdited->order_id, $this->cashbackUsed);

            $orderOriginal->editedCopy()->delete();

            DB::commit();
            $this->redirect(route('customer.orders.show', ['order' => $orderOriginal->id]));
        } catch (\Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . $e->getMessage());
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.edit_order'),
                'message' => __('custom::site.order_save_fail'),
                'state' => 'danger'
            ]);
        }
    }

    public function eventSetPaymentType($id, $name)
    {
        if ($paymentType = PaymentType::find($id)) {
            $this->paymentType = $paymentType;
            $this->revalidateFootableValues = true;
        }
    }

    public function eventSetOrderContract($id, $name)
    {
        if ($contract = Contract::find($id)) {
            $this->contract = $contract;
            $this->revalidateFootableValues = true;
        }
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
            $this->revalidateProducts()->map->orderCost->sum()
        );
    }

    private function setFilterableSearchList($value)
    {
        if ($value = trim($value)) {
            $ids = $this->order->products->pluck('id');
            return Product::query()
                ->whereNotIn('id', $ids)
                ->whereTranslationLike('name', "%{$value}%")
                ->orWhere('articul', 'like', "%{$value}%")
                ->orWhere('articul_search', 'like', "%{$value}%")
                ->orWhereHas('brand', function ($q) use ($value) {
                    $q->whereTranslationLike('title', "%{$value}%");
                })
                ->take(10)->get()->keyBy('id')
                ->map(fn($p) => $p->name . " ({$p->articul})")
                ->toArray();
        }

        return [];
    }

    protected function revalidateProducts()
    {
        return $this->order->products
            ->each(function(Product $p){
                $p->orderUuid = $p->pivot->uuid;
                $p->orderPrice = $p->pivot->price;
                $p->orderQuantity = $p->pivot->quantity;
                $p->orderOldQty = $this->getOfferProductAvailableQuantity($p);
                $p->orderCost = $p->orderPrice * $p->orderQuantity;
                $p->orderWeight = $p->weight * $p->orderQuantity;
                $p->orderVolume = $p->volume * $p->orderQuantity;
                $p->orderOfferId1c = $this->getPersonalOfferId1c($p->pivot);
            });
    }

    protected function getOfferProductAvailableQuantity($product)
    {
        if ($this->isProductBelongValidOffer($product->pivot)) {
            $offerId1c = $this->getPersonalOfferId1c($product->pivot);
            $offer = $product->personalOffers()->where('id_1c', $offerId1c)->first();
        }

        return !empty($offer)
            ? $offer->pivot->quantity
            : $product->pivot->old_qty;
    }
}
