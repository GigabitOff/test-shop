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

    public function checkChatsMessage()
    {
        //dd();
        if (session('playAudio') === true) {
            $message = ChatMessage::latest()->first();
            if (!session()->exists('lastMessage')) {
                session()->put('lastMessage', $message->id);
            }

            if (session('lastMessage') != $message->id and $message->owner_id != auth()->guard('admin')->user()->id) {
                session()->put('lastMessage', $message->id);
                $this->dispatchBrowserEvent('startAudioMessage');
            }
        }
    }

}
