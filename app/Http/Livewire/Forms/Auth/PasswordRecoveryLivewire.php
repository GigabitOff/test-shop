<?php

namespace App\Http\Livewire\Forms\Auth;

use App\Models\User;
use App\Services\OtpService;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class PasswordRecoveryLivewire extends Component
{
    const MODE_RECOVERY = 'recovery';
    const MODE_VERIFICATION = 'verification';

    public string $phoneRaw = '';
    public string $phone = '';
    public string $code = '';

    public string $mode = self::MODE_RECOVERY;
    public string $password = '';

    // Текст причины отображения формы.
    // Используется при событийном вызове формы.
    public string $reasonMessage = '';

    protected $listeners = [
        'eventRestoreForm',
        'eventSetTargetPhone',
    ];

    protected array $rules = [
        'phone' => 'required|exists:users,phone',
        'code' => 'required|digits:6',
    ];

    protected OtpService $otpService;

    public function boot()
    {
        $this->otpService = app()->make(OtpService::class);
    }

    public function render()
    {
        return view('livewire.forms.auth.password-recovery-livewire', [
            'prompt' => $this->getPromptMessage(),
        ]);
    }

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/\D/', '', $value);
    }

    /**
     * @throws ValidationException
     */
    public function submit()
    {
        $this->validateOnly('phone');

        /** @var User $user */
        $user = User::query()->where('phone', $this->phone)->first();

        if ($this->isRecoveryMode()) {

            $this->reset(['code']);
            $this->sendCode(true);
            $user->setOption('query_password_change_after_login', true, true);
            $this->setModeVerification();

        } elseif ($this->isVerificationMode()) {
            $this->validateOnly('code');

            if (!$this->otpService->validate($user->phone, $this->code)) {
                throw ValidationException::withMessages([
                    'code' => __('custom::site.password_entered_fail'),
                ]);
            }

            if(!$this->userRoleAllowed($user)) {
                return;
            }

            auth()->login($user);

            $this->otpService->markCodeAsUsed($user->phone, $this->code);

            $this->emitSelf('eventRestoreForm');

            $this->redirect(url()->previous());
            $this->shouldSkipRender = false;
        }
    }

    /** ========== Event handlers ========== */
    public function eventRestoreForm()
    {
        $this->restoreForm();
    }

    /**
     * Запуск формы по событию
     * По умолчанию автоотображение формы.
     *
     * @param $payload
     * @return void
     */
    public function eventSetTargetPhone($payload)
    {
        $this->restoreForm();
        $this->phone = $payload['phone'] ?? '';
        $this->phoneRaw = formatPhoneNumber($this->phone);
        $this->reasonMessage = $payload['message'] ?? '';

        if ($payload['show'] ?? true) {
            $this->dispatchBrowserEvent('showModal', [
                'modalId' => 'm-password-recovery',
            ]);
        }
    }

    public function restoreForm()
    {
        $this->reset(['phoneRaw', 'phone', 'code', 'password']);
        $this->setModeRecovery();
    }

    public function back()
    {
        $this->setModeRecovery();
    }

    public function getPromptMessage(): string
    {
        return $this->isRecoveryMode()
            ? __('custom::site.password_recovery_prompt')
            : sprintf(__('custom::site.password_recovery_verification_prompt'), $this->phoneRaw);
    }

    public function getModalTitle()
    {
        return $this->isRecoveryMode()
            ? __('custom::site.password_recovery')
            : __('custom::site.phone_verification');
    }

    protected function setModeRecovery()
    {
        $this->mode = self::MODE_RECOVERY;
    }

    protected function setModeVerification()
    {
        $this->mode = self::MODE_VERIFICATION;
    }

    public function isRecoveryMode(): bool
    {
        return $this->mode === self::MODE_RECOVERY;
    }

    public function isVerificationMode(): bool
    {
        return $this->mode === self::MODE_VERIFICATION;
    }

    public function sendCode($silently = false)
    {
        $valid = $this->validateOnly('phone');
        $code = $this->otpService->generate($valid['phone']);

        smsSend($this->phone, sprintf(__('custom::site.otp_code_sms'), $code),  'otp login');

        if(!$silently){
            session()->flash('otp_code_resent', __('custom::site.otp_code_resent'));
        }
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
