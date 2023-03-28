<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\Catalog\Product\CatalogProductController;
use App\Models\ProductPriceTracking;
use App\Models\User;
use Livewire\Component;

class ProductPriceTracker extends Component
{
    public $product_id;
    public $price;
    public $user;

    public $listeners = [
        'eventFollowPrice'    => 'followPrice',
        'eventSaveTracking'   => 'saveTracking',
        'eventRemoveTracking' => 'unsubscribeTracking',
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function followPrice($payload)
    {
        $product_id = $payload['product_id'];
        $price = $payload['price'];
        /** @var User $user */
        $user = auth()->user();
        if (!$user) {
            $this->dispatchBrowserEvent('loginBeforeSubscribeToFollowPrice', CatalogProductController::ACTION_REGISTER_AND_SUBSCRIBE);
        } else {
            if (empty($user->email)) {
                $this->emitTo('forms.auth.set-email-livewire', 'eventSetUserEmail', $user->id, $product_id, $price);
            } else {
                $this->saveTracking($user->id, $product_id, $price);
            }
        }
    }

    public function unsubscribeTracking($payload)
    {
        /** @var User $user */
        $user = auth()->user();
        if (!$user) {
            $this->dispatchBrowserEvent('loginBeforeSubscribeToFollowPrice', CatalogProductController::ACTION_REGISTER_AND_UNSUBSCRIBE);
        } else {
            $this->removeTracking($payload['hash']);
        }
    }

    public function render()
    {
        return view('livewire.components.product-price-tracker');
    }

    public function saveTracking($user_id, $product_id, $price)
    {
        ProductPriceTracking::updateOrCreate(
            [
                'customer_id' => $user_id,
                'product_id'  => $product_id,
            ], [
                'product_price' => $price,
                'hash'          => sha1(sprintf('%d-%d-%.2f', $user_id, $product_id, $price)),
            ]
        );
        $this->dispatchBrowserEvent('successToFollowPrice');
    }

    public function removeTracking($hash)
    {
        ProductPriceTracking::where('hash', $hash)->delete();
        $this->dispatchBrowserEvent('successUnsubscribedPrice');
    }
}
