<?php

namespace App\Http\Livewire\Customer\Widget;

use App\Models\PaymentType;
use App\Models\User;
use Livewire\Component;

class PersonalDataWidget extends Component
{
    public $user_name;
    public $user_phone;
    public $user_phone_verified;
    public $user_email;
    public $user_city;
    public $user_edrpou;
    public $user_company;
    public $user_position;
    public $user_with_vat;
    public $payment_type;
    public $needPaymentTypeEditForm = false;

    protected ?User $user;

    protected $listeners = [
        'changedDefaultPaymentType',
        'eventPersonalDataChanged',
        'eventCounterpartyCreated',
        'eventCounterpartyChanged',
    ];

    public function boot()
    {
        $this->user = auth()->user();
    }

    public function mount()
    {
        $this->revalidate();
    }

    public function render()
    {
        if ($this->user) {
            $this->revalidate();
            return view('livewire.customer.widget.personal-data-widget', [
                'user' => $this->user,
                'changes' => $this->user->changes,
                ]
            );
        }
        return '';
    }

    public function revalidate()
    {
        if ($this->user) {
            $this->user_name = $this->user->name;
            $this->user_phone = $this->user->phone;
            $this->user_phone_verified = $this->user->isPhoneVerified();
            $this->user_email = $this->user->email;

            $paymentTypeId = $this->user->payment_type_id ?? $this->user->defaultPaymentType;
            $paymentType = PaymentType::find($paymentTypeId);
            if ($paymentType) {
                $this->payment_type = $paymentType->name;
            }
            if ($this->user->city) {
                $this->user_city = $this->user->city->name_uk;
            }
            if ($counterparty = $this->user->counterparty) {
                $this->user_company = $counterparty->name;
                $this->user_edrpou = $counterparty->okpo;
                $this->user_with_vat = $counterparty->is_nds ? __('custom::site.yes') : __('custom::site.no');
                $this->user_position = $this->user->position;
            }
        }
    }

    public function changedDefaultPaymentType()
    {
        $this->revalidate();
    }

    public function eventPersonalDataChanged()
    {
        $this->revalidate();
    }

    public function eventCounterpartyCreated()
    {
        $this->revalidate();
    }

    public function eventCounterpartyChanged()
    {
        $this->revalidate();
    }

    public function uploadPaymentTypeEditForm()
    {
        $this->needPaymentTypeEditForm = true;
    }
}
