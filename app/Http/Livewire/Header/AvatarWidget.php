<?php

namespace App\Http\Livewire\Header;

use App\Models\User;
use Livewire\Component;

class AvatarWidget extends Component
{
    /** @var User|null  */
    public $user;
    public $user_avatar;
    public $user_name;

    protected $listeners = [
        'eventPersonalDataChanged',
    ];

    public function mount()
    {
        $this->restoreFromModel();
    }

    public function render()
    {
        return view('livewire.header.avatar-widget');
    }

    protected function restoreFromModel(){
        if (auth()->check()) {
            $this->user = auth()->user();
        }

        $this->user_name = __('custom::site.user');
        $this->user_avatar = '/assets/img/user.svg';

        if ($this->user){
            $this->user_avatar = $this->user->correctAvatar() ?: '/assets/img/user.svg';
            $this->user_name = $this->user->name ?: __('custom::site.user');
        }
    }

    public function eventPersonalDataChanged()
    {
        $this->restoreFromModel();
    }


}
