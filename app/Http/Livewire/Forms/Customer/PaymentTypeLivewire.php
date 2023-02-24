<?php

namespace App\Http\Livewire\Forms\Customer;

use App\Models\PaymentType;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PaymentTypeLivewire extends Component
{
    public $paymentTypes = [];
    public $isUploadLazyContent = false;

    public function render()
    {
        if ($this->isUploadLazyContent) {
            $this->reload();
        }
        return view('livewire.forms.customer.payment-type-livewire');
    }

    public function reload()
    {
        $user = auth()->user();
        $paymentTypesAvailableIds = DB::table('payment_types_available')
            ->select('payment_type_id')
            ->where('customer_type_id', 1 + (int) $user->hasRole('legal'))
//            ->where('customer_type_id', $user->customer_type->value)
            ->pluck('payment_type_id');
        $this->paymentTypes = PaymentType::query()
            ->whereIn('id', $paymentTypesAvailableIds)->get();
    }

    public function setPaymentType($paymentTypeId = 0)
    {
        if ($paymentType = PaymentType::find((int)$paymentTypeId)){
            $user = auth()->user();
            $user->paymentType()->associate($paymentType);
            $user->save();

            $this->emit('changedDefaultPaymentType');
        }
    }

    public function uploadLazyContent($payload = null)
    {
        $this->isUploadLazyContent = true;
    }
}
