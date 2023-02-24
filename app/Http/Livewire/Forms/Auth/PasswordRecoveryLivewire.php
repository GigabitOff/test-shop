<?php

namespace App\Http\Livewire\Forms\Auth;

use App\Models\User;
use App\Services\UsersService;
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

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/\D/', '', $value);
    }

    public function render()
    {
        return view('livewire.forms.auth.password-recovery-livewire', [
            'prompt' => $this->getPromptMessage(),
        ]);
    }

    public function submit(UsersService $service)
    {
        $this->validate();

        /** @var User $user */
        $user = User::query()->where('phone', $this->phone)->first();

        if ($this->isRecoveryMode()) {

            $this->reset(['code']);
            $this->password = stringDigit(6);

            $service->sendRecoveryCode($user, $this->password);
            $user->setOption('show_password_change', true, true);

            $this->setModeVerification();

        } elseif ($this->isVerificationMode()) {

            $service->setPasswordFromRecoveryCode($user);

            $this->showSuccessModal();

            $this->emitSelf('eventRestoreForm');
        }

    }

    protected function showSuccessModal()
    {
        $this->emit('eventShowDialogMessage', [
            'title' => __('custom::site.password_recovery'),
            'message' => __('custom::site.password_recovery_success'),
            'buttons' => [
                [
                    'text' => __('custom::site.to_login_form'),
                    'actions' => [
                        [
                            'type' => 'sendEvent',
                            'target' => 'eventSetLoginPhone',
                            'payload' => $this->phone,
                        ],
                        [
                            'type' => 'showModal',
                            'target' => 'm-login',
                        ]
                    ]
                ]
            ]
        ]);
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

    public function rules(): array
    {
        switch (true) {
            case $this->isVerificationMode():
                return [
                    'code' => "in:{$this->password}",
                ];
            default:
                return [
                    'phone' => 'required|bail|min:12|exists:users,phone',
                ];
        }
    }

    public function messages(): array
    {
        return [
            'code.in' => __('custom::site.password_entered_fail'),
        ];
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

}
