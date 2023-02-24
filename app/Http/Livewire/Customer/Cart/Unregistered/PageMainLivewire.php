<?php

namespace App\Http\Livewire\Customer\Cart\Unregistered;

use App\Models\Contract;
use App\Models\CustomerRecipient;
use App\Models\DeliveryAddress;
use App\Models\OrderStatusType;
use App\Models\PaymentType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PageMainLivewire extends Component
{

    protected $listeners = [
        'eventFastOrderCreated',
        'eventCheckAllChanged',
    ];

    public function render()
    {
        $products = cart()->products();

        $checkedCount = $products->filter->cartChecked->count();
        $checkAll = $checkedCount && ($checkedCount === $products->count());

        $this->dispatchBrowserEvent('updateCheckAllCheckbox', ['checkAll' => $checkAll]);

        $this->dispatchBrowserEvent('updatePageMainValues', [
            'products' => $products->keyBy('cartUuid')
                ->map(function ($p) {
                    return [
                        'cartCost' => formatMoney($p->cartCost),
                        'price' => formatMoney($p->price),
                        'checked' => $p->cartChecked,
                    ];
                })
        ]);

        $table = view('livewire.customer.cart.products-footable-render', [
            'products' => $products,
            'checkAll' => $checkAll,
        ])->render();

        return view('livewire.customer.cart.unregistered.page-main-livewire', [
            'table' => $table,
            'products' => $products,
            'checkAll' => $checkAll,
        ]);
    }

    public function checkAll($checked = false)
    {
        cart()->checkProducts(cart()->productUuids()->toArray(), $checked);
    }

    public function clearList()
    {
        cart()->clear();
        $this->emit('eventCartChanged');
    }

    public function removeProduct($uuid)
    {
        cart()->removeProducts($uuid);
        $this->emit('eventCartChanged');
    }

    public function setCheckProduct($uuid, $checked)
    {
        cart()->checkProducts($uuid, $checked);
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
            $this->emit('eventCartChanged');
        }
    }

    /** События */

    public function createOrder()
    {
        if (cart()->totalCartCheckedQuantity() < 1) {
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.order'),
                'message' => __('custom::site.choice_products_for_order'),
                'state' => 'danger'
            ]);
            return;
        }
        $this->dispatchBrowserEvent('showQuickPurchaseModal');

    }

    public function eventFastOrderCreated()
    {
        $this->emit('eventCartChanged');
    }

    public function eventCheckAllChanged($checked)
    {
        cart()->checkProducts(cart()->productUuids()->toArray(), $checked);
    }

}
