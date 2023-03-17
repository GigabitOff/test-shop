<?php

namespace App\Http\Livewire\Header;

use Livewire\Component;
use App\Models\ChatMessage;

class CartWidget extends Component
{

    protected $listeners = [
        'eventCartChanged',
    ];
    public function mount()
    {
        $this->checkChatsMessage();
    }

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
        $sendEmitReloadMessages = false;
        //if (session('playAudio') === true) {
            foreach (auth()->user()->chats as $key => $value) {
            # code...
                if($message = $value->latestMessage()->first() AND $message->owner_id != auth()->user()->id)
                $sendEmitReloadMessages = true;
            }
            //$message = ChatMessage::latest()->first();
            if (!session()->exists('lastMessage') AND isset($message->id)) {
                session()->put('lastMessage', $message->id);
            }

            if (session('lastMessage') != $message->id and $message->owner_id != auth()->user()->id AND $sendEmitReloadMessages === true) {
                session()->put('lastMessage', $message->id);
                $this->dispatchBrowserEvent('startAudioMessage');

            $sendEmitReloadMessages = false;
            }
       // }
    }

}
