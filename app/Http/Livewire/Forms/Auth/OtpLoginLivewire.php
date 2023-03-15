<?php

namespace App\Http\Livewire\Forms\Auth;

use App\Models\User;
use App\Services\OtpService;
use Livewire\Component;

class OtpLoginLivewire extends Component
{
    public string $phoneRaw = '';
    public string $phone = '';
    public string $code = '';

    protected OtpService $otpService;

    protected array $rules = [
        'phone' => 'required|exists:users,phone',
        'code' => 'required|digits:6',
    ];

    protected $listeners = [
        'eventSetLoginPhone',
    ];

    public function boot()
    {
        $this->otpService = app()->make(OtpService::class);
    }

    public function render()
    {
        return view('livewire.forms.auth.otp-login-livewire');
    }

    public function submit()
    {
        $this->resetErrorBag();
        $credentials = $this->validate();

        if ($this->otpService->validate($credentials['phone'], $credentials['code'])) {
            $user = User::where('phone', $credentials['phone'])->first();

            auth()->login($user);

            $this->otpService->markCodeAsUsed($credentials['phone'], $credentials['code']);

            if ($user->isOptionExists('query_password_change_after_login')){
                $user->setOption('query_password_change_after_login', true, true);
            }

            $this->redirect(url()->previous());
            $this->shouldSkipRender = false;
        } else {
            session()->flash('otp_code_fail', __('custom::site.otp_code_fail'));
        }
    }

    public function restoreForm()
    {
        $this->reset([
            'phoneRaw',
            'phone',
        ]);
    }

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/\D/', '', $value);
    }


    /** ========== Event handlers ========== */
    public function eventSetLoginPhone(string $phone = '')
    {
        if ($phone) {
            $this->phone = $phone;
            $this->phoneRaw = formatPhoneNumber($phone);
        }
    }

    public function resendCode()
    {
        $valid = $this->validateOnly('phone');
        $code = $this->otpService->generate($valid['phone']);

        smsSend($this->phone, sprintf(__('custom::site.otp_code_sms'), $code),  'otp login');

        session()->flash('otp_code_resent', __('custom::site.otp_code_resent'));
    }

    private function userRoleAllowed(User $user): bool
    {
        $denyRoles = config('app.deny_roles.site', []);

        if ($denyRoles && $user->hasAnyRole($denyRoles)) {
            return false;
        }

        return true;
    }
}
