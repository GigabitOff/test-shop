<?php

namespace App\Http\Livewire\Components;

use App\Models\ProductPriceTracking;
use App\Models\User;
use Livewire\Component;

class ProductPriceTracker extends Component
{
    public $product_id;
    public $user;

    public $listeners = [
        'eventFollowPrice' => 'followPrice',
        'eventSaveTracking' => 'saveTracking',
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function followPrice($payload)
    {
        $product_id = $payload['product_id'];
        session(['followPriceProductId' => $product_id]);
        /** @var User $user */
        $user = auth()->user();
        if (!$user) {
            $this->dispatchBrowserEvent('loginBeforeSubscribeToFollowPrice', $product_id);
        } else {
            if (empty($user->email)) {
                $this->emitTo('forms.auth.set-email-livewire', 'eventSetUserEmail', $user->id, $product_id );
            } else {
                $this->saveTracking($user->id, $product_id);
            }
        }
    }

    public function render()
    {
        return view('livewire.components.product-price-tracker');
    }

    public function saveTracking($user_id, $product_id)
    {
        ProductPriceTracking::updateOrCreate(
            [
                'customer_id' => $user_id,
                'product_id' => $product_id,
            ], [
                'product_id' => $product_id,
            ]
        );
        session(['followPriceProductId' => 0]);
        $this->dispatchBrowserEvent('successToFollowPrice');
    }
}
