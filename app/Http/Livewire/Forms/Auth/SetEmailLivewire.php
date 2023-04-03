<?php

namespace App\Http\Livewire\Forms\Auth;

use App\Http\Livewire\Components\ProductPriceTracker;
use App\Models\User;
use Livewire\Component;

class SetEmailLivewire extends Component
{
    public string $email = '';

    public $listeners = [
        'eventSetUserEmail',
    ];

    protected array $rules = [
        'email' => 'required|email:rfc,dns',
    ];

    public function render()
    {
        return view('livewire.forms.auth.set-email-livewire');
    }

    public function eventSetUserEmail()
    {
        $this->dispatchBrowserEvent('showEmailForm');
    }

    public function submit()
    {
        $this->validate();
        $user = auth()->user();
        if ($user) {
            $user->email = $this->email;
            $user->save();
            session(['follow_price_action' => ProductPriceTracker::ACTION_REGISTER_AND_SUBSCRIBE]);
        }
        $this->emitTo('components.product-price-tracker', 'eventSaveTracking');
    }
}
