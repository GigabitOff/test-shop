<?php

namespace App\Http\Livewire\Header;

use App\Models\User;
use Livewire\Component;

class AvatarMobileWidget extends Component
{
    public ?User $user;
    public string $avatarUrl;

    protected $listeners = [
        'eventPersonalDataChanged',
    ];

    public function boot()
    {
        $this->user = auth()->user();
    }

    public function mount()
    {
        $this->restoreFromModel();
    }

    public function render()
    {
        return view('livewire.header.avatar-mobile-widget');
    }

    protected function restoreFromModel()
    {
        $default = '/assets/img/user.svg';
        $this->avatarUrl = $this->user
            ? $this->user->correctAvatar($default)
            : $default;
    }

    public function eventPersonalDataChanged()
    {
        $this->restoreFromModel();
    }


}
