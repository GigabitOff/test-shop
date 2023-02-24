<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;

class ClientCartLivewire extends Component
{

    protected $cart_changed = false;

    protected $listeners = [
        'eventCartChanged'
    ];

    public function render()
    {
        $cartInfo = [
            'totalQty' => cart()->totalCartCheckedQuantity(),
            'totalCost' => cart()->totalCartCheckedCost(),
            //'totalWeight' =>
        ];

        return view('livewire.cart.client-cart-livewire', [
            'cartInfo' => $cartInfo,
        ]);
    }
    public function eventCartChanged()
    {
        // просто переотрисовка
    }
    public function createOrder()
    {
//        if (cart()->isNotEmpty()){
//            orders()->createOrderFromCart();
//
//        }
    }
}
