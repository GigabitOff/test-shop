<?php

namespace App\Http\Livewire\Forms\Customer;

use App\Models\User;
use Livewire\Component;

class PhoneVerificationLivewire extends Component
{
    const MODE_PROMPT = 'prompt';
    const MODE_VERIFICATION = 'verification';

    /** @var User $user */
    public $user;

    public $phone;
    public $code;

    public $mode = self::MODE_PROMPT;
    public $password;

    public $isUploadLazyContent = false;

    public function boot()
    {
        $this->user = auth()->user();
        $this->phone = $this->user->phone;
    }

    public function render()
    {
        $prompt = ($this->mode === self::MODE_VERIFICATION)
            ? sprintf(__('custom::site.phone_verification_code_prompt'), formatPhoneNumber($this->phone))
            : sprintf(__('custom::site.phone_verification_prompt'), formatPhoneNumber($this->phone));

        return view('livewire.forms.customer.phone-verification-livewire', [
            'prompt' => $prompt,
        ]);
    }

    public function submit()
    {
        $this->validate();

        try {
            $user = User::where('phone', $this->phone)->first();
            $user->phone_verified_at = now();
            $user->save();

            $this->emit('eventPersonalDataChanged');
        } catch (\Exception $e) {
            session()->flash('fail', __('custom::site.phone_verification_fail'));
        }
    }

    public function sendCode()
    {
        $this->reset(['code']);
        $this->password = stringDigit(6);

        smsSend($this->phone, sprintf(__('custom::site.phone_verification_sms'), $this->password), 'phone verification');

        $this->mode = self::MODE_VERIFICATION;
    }

    public function rules()
    {
        return [
            'code' => "in:{$this->password}",
        ];
    }

    public function messages()
    {
        return [
            'code.in' => __('custom::site.phone_verification_code_fail'),
        ];
    }

    public function back()
    {
        $this->mode = self::MODE_VERIFICATION;
    }

    public function uploadLazyContent($payload = null)
    {
        if (!isset($payload['phone'])) {
            session()->flash('fail_customer', __('custom::site.customer_undefined'));
        }

        $this->phone = $payload['phone'];

        $this->isUploadLazyContent = true;
        $this->mode = self::MODE_PROMPT;
    }

}
