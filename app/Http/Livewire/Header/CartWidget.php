<?php

namespace App\Http\Livewire\Header;

use Livewire\Component;
use App\Models\ChatMessage;

class CartWidget extends Component
{

    protected $listeners = [
        'eventCartChanged',
    ];


    public function render()
    {

        return view('livewire.header.cart-widget', [
            'quantity' => cart()->totalQuantity(),
            'cost' => cart()->totalCost(),
        ]);

    }

    public function eventCartChanged()
    {
        // просто переотрисовка
    }



}
