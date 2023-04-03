<?php

namespace App\Http\Livewire\Components;

use App\Models\ProductPriceTracking;
use Livewire\Component;

class ProductPriceTracker extends Component
{
    const ACTION_NOTHING = 0;
    const ACTION_FILL_EMAIL = 1;
    const ACTION_ADD_TO_CART = 2;
    const ACTION_REGISTER_AND_ADD_TO_CART = 3;
    const ACTION_REGISTER_AND_UNSUBSCRIBE = 4;
    const ACTION_SHOW_ADDED_TO_CART_MESSAGE = 5;
    const ACTION_SHOW_UNSUBSCRIBED_MESSAGE = 6;
    const ACTION_REGISTER_AND_SUBSCRIBE = 7;

    public $product_id;
    public $price;
    public $user;

    public $action;
    public $hash;

    public $listeners = [
        'eventFollowPrice'           => 'followPrice',
        'eventSaveTracking'          => 'saveTracking',
        'eventRemoveTracking'        => 'removeTracking',
        'userIsSuccessfullyLoggedIn' => 'userLoggedIn',
        'userIsFailedLoggedIn'       => 'clearAction',
    ];

    public function mount()
    {
        $this->user = auth()->user();
        $this->action = session('follow_price_action', self::ACTION_NOTHING);
        $this->hash = session('unsubscribe_hash', '');
    }

    public function userLoggedIn()
    {
        $this->user = auth()->user();
        switch ($this->action) {
            case self::ACTION_REGISTER_AND_ADD_TO_CART:
                $this->addProductToCart();
                break;
            case self::ACTION_REGISTER_AND_SUBSCRIBE:
                $this->addTracking();
                break;
            case self::ACTION_REGISTER_AND_UNSUBSCRIBE:
                $this->removeTracking();
                break;
        }
    }

    public function clearAction()
    {
        $this->saveAction(self::ACTION_NOTHING);
    }

    public function followPrice($payload)
    {
        $this->product_id = $payload['product_id'];
        $this->price = $payload['price'];
        $this->saveAction(self::ACTION_REGISTER_AND_SUBSCRIBE);
        if (!$this->user) {
            $this->emit('loginBeforeSubscribeToFollowPrice');
        } else {
            $this->addTracking();
        }
    }

    private function addTracking()
    {
        if (empty($this->user->email)) {
            $this->saveAction(self::ACTION_REGISTER_AND_SUBSCRIBE);
            $this->emit('showEmailForm');
        } else {
            $this->saveAction(self::ACTION_NOTHING);
            $this->saveTracking();
        }

    }

    public function render()
    {
        return view('livewire.components.product-price-tracker');
    }

    public function saveTracking()
    {
        ProductPriceTracking::updateOrCreate(
            [
                'customer_id' => $this->user->id,
                'product_id'  => $this->product_id,
            ], [
                'product_price' => $this->price,
                'hash'          => sha1(sprintf('%d-%d-%.2f', $this->user->id, $this->product_id, $this->price)),
            ]
        );
        $this->saveAction(self::ACTION_NOTHING);
        $this->emit('successToFollowPrice');
    }

    public function removeTracking()
    {
        ProductPriceTracking::where('hash', $this->hash)->delete();
        $this->saveAction(self::ACTION_NOTHING);
        $this->emit('successUnsubscribedPrice');
    }

    public function addProductToCart()
    {
        $this->emit('eventCartAddProduct', [
            'product_id'        => $this->product_id,
            'show_notification' => 1,
            'price_added'       => $this->price,
            'quantity'          => 1,
        ]);
        $this->saveAction(self::ACTION_NOTHING);
    }

    private function saveAction($action)
    {
        $this->action = $action;
        self::persistAction($action);
    }

    public static function persistAction($action)
    {
        session(['follow_price_action' => $action]);
    }
}
