<?php

namespace App\Http\Livewire\Customer\Users\Clients;

use App\Http\Livewire\Admin\Users\UserComponentLivewire;
use Livewire\WithPagination;

class UserClientsBlockedLivewire extends UserComponentLivewire
{

    use WithPagination;
    public $phone;


    public function mount()
    {
        $this->data['blocked_ip_id'] = $this->data_collect->blocked_ip_id;
        $this->getEntrances(10);
    }

    public function render()
    {
        return view('livewire.customer.users.clients.user-clients-blocked-livewire');
    }
}
