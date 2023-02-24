<?php

namespace App\Http\Livewire\Customer\Widget;

use App\Models\User;
use Livewire\Component;

class MessagesWidgetLivewire extends Component
{
    public function render()
    {
        /** @var User */
        $customer = auth()->user();

        $count = $customer->chats()
            ->whereHas('messages', function($q) use ($customer){
                $q->where('owner_id', '!=', $customer->id)
                    ->where('viewed', false);
            })
            ->count();

        return view('livewire.customer.widget.messages-widget-livewire', [
            'count' => $count,
        ]);
    }

}
