<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class ProductPriceTracker extends Component
{
    public $product_id;
    public $user;

    public $listeners = [
        'eventFollowPrice',
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function eventFollowPrice($payload)
    {
        if (!$this->user) {
            $this->dispatchBrowserEvent('loginBeforeSubscribeToFollowPrice', $payload['product_id']);
        } else {
            if (empty($this->user->email)) {
                $this->dispatchBrowserEvent('subscribeToFollowPrice', $payload['product_id']);
            } else {
                $this->dispatchBrowserEvent('successToFollowPrice');
            }
        }
    }

    public function render()
    {
        return view('livewire.components.product-price-tracker');
    }
}
