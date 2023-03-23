<?php

namespace App\Http\Livewire\Forms\Auth;

use App\Models\User;
use Livewire\Component;

class SetEmailLivewire extends Component
{
    public string $email = '';
    public int $user_id;
    public int $product_id;

    public $listeners = [
        'eventSetUserEmail'
    ];

    protected array $rules = [
        'email' => 'required|email:rfc,dns',
    ];

    public function render()
    {
        return view('livewire.forms.auth.set-email-livewire');
    }

    public function eventSetUserEmail($user_id, $product_id)
    {
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->dispatchBrowserEvent('subscribeToFollowPrice');
    }

    public function submit()
    {
        $this->validate();
        $user = User::where('id', $this->user_id)->firstOrFail();
        $user->email = $this->email;
        $user->save();
        $this->emitTo('components.product-price-tracker', 'eventSaveTracking', $this->user_id, $this->product_id);
    }
}
