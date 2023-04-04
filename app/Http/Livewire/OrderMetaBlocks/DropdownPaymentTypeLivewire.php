<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Models\User;
use Livewire\Component;

class DropdownPaymentTypeLivewire extends Component
{
    public User $customer;
    public ?int $paymentId = 0;
    public string $paymentName = '';
    public array $paymentList = [];


    public function mount()
    {

        $this->paymentList = $this->customer->availablePaymentTypes()
            ->get()->keyBy('id')->map->name->toArray();

        if (!$this->paymentId || !isset($this->paymentList[$this->paymentId])) {
            $id = $this->customer->payment_type_id ?? $this->customer->defaultPaymentType;
            $this->paymentId = isset($this->paymentList[$id]) ? $id : 0;
        }
        if ($this->paymentId || !isset($this->paymentList[$this->paymentId])) {
            $id = $this->customer->payment_type_id ?? 5;
            $this->paymentId = isset($this->paymentList[$id]) ? $id : 0;
        }
        $this->paymentName = $this->paymentList[$this->paymentId] ?? '';
    }

    public function render()
    {
        return view('livewire.order-meta-blocks.dropdown-payment-type-livewire');
    }


    public function updatedPaymentId($id)
    {

        $this->paytype = $this->paymentId;
        $this->paymentName = $this->paymentList[$id] ?? '';
        $this->emit('eventSetOrderPaymentType', $id, $this->paymentName, $this->paytype);
        $this->refreshT();
    }

    public function refreshT()
    {
        $this->emit('eventT',  $this->paytype);
    }

}
