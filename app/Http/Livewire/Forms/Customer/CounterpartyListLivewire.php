<?php

namespace App\Http\Livewire\Forms\Customer;

use App\Models\User;
use Livewire\Component;

class CounterpartyListLivewire extends Component
{
    public $customer;
    public $counterparties;
    public $isUploadLazyContent = false;

    public function render()
    {
        return view('livewire.forms.customer.counterparty-list-livewire');
    }

    public function reload()
    {
        $this->counterparties = $this->customer->counterparties;
    }

    public function uploadLazyContent($payload = null)
    {
        if (isset($payload['customer_id'])){
            $this->customer = User::find($payload['customer_id']);
        }

        $this->customer = $this->customer ?? auth()->user();

        $this->reload();
        $this->isUploadLazyContent = true;
    }
}
