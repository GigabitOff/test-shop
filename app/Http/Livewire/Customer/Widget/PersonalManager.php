<?php

namespace App\Http\Livewire\Customer\Widget;

use Livewire\Component;

class PersonalManager extends Component
{
    public $user_name;
    public $user_phone;
    public $user_phone_raw;
    public $user_email;
    public $user_avatar, $data;

    protected $rules = [
        "data.fio" => "required|min:4",
        "data.message" => "required|min:4",
        "data.email" => "required|email",
    ];

    /** @var \App\Models\User $user */
    protected $user;

    protected $listeners = [];

    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->user = auth()->user()->manager;
    }

    public function mount()
    {
        if ($this->user) {
            $this->user_name = $this->user->name;
            $this->user_phone = formatPhoneNumber($this->user->phone);
            $this->user_phone_raw = $this->user->phone;
            $this->user_email = $this->user->email;
            $this->user_avatar = $this->user->correctAvatar() ?: '/assets/img/user.svg';
        }
    }

    public function render()
    {
        if ($this->user) {
            return view('livewire.customer.widget.personal-manager');
        }
        return '';
    }

    public function sendData()
    {
        $this->validate();
    }

}
