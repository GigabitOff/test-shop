<?php

namespace App\Http\Livewire\Forms\Auth;

use App\Models\BlockIp;
use App\Models\IpFailedLogin;
use App\Models\User;
use App\Services\IpFailedLoginService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginLivewire extends Component
{

    const RECOVERY_FAILED_LOGIN = 5;
    const BLOCK_FAILED_LOGIN = 8;

    public string $phoneRaw = '';
    public string $password = '';

    public string $phone = '';
    public int $failedAttempts = 0;
    public int $blockHours = 0;

    protected IpFailedLoginService $service;

    protected array $rules = [
        'phone' => 'required|exists:users,phone',
        'password' => 'required',
    ];

    protected $listeners = [
        'eventSetLoginPhone',
    ];

    public function boot()
    {
        $this->service = app()->make(IpFailedLoginService::class);
    }

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/\D/', '', $value);
    }

    public function render()
    {
        return view('livewire.forms.auth.login-livewire');
    }

    /** ========== Event handlers ========== */
    public function eventSetLoginPhone(string $phone = '')
    {
        if ($phone) {
            $this->phone = $phone;
            $this->phoneRaw = formatPhoneNumber($phone);
        }
    }

    public function submit()
    {
        $credentials = $this->validate();
        $this->resetErrorBag();

        if ($this->isIpBlocked()) {
            $this->showIpBlockedMessage();
            return;
        }

        if ($this->isUserBlocked()) {
            $this->showUserBlockedMessage();
            return;
        }

        if (Auth::attempt($credentials)) {

            $user = auth()->user();
            $denyRoles = config('app.deny_roles.site', []);

            if ($denyRoles && $user->hasAnyRole($denyRoles)) {
                auth()->logout();
            } else {
                if ($user->isOptionExists('query_password_change_after_login')){
                    $user->setOption('query_password_change_after_login', true, true);
                }
                $this->redirect(url()->previous());
                $this->shouldSkipRender = false;

                $this->service->clearFailedLogins($this->phone);
                return;
            }
        } else {
            $this->service->addFailedLogin($this->phone);
            $this->tryUserBlock();
        }

        session()->flash('auth_fail', __('custom::site.auth_fail'));
    }

    public function restoreForm()
    {
        $this->reset([
            'phoneRaw',
            'phone',
            'password',
        ]);
    }

    public function loginUser($id)
    {
        if ($user = User::find((int)$id)) {
            auth()->login($user);
            $this->redirect(url()->previous());
        }
    }

    public function tryUserBlock()
    {
        $failedCount = $this->service->getFailedLoginsQuantity($this->phone);

        if ($this->tryIpBlocked($failedCount)) {
            $this->showIpBlockedMessage();
            return;
        }

        $this->tryRecoveryPassword($failedCount);
    }

    protected function tryIpBlocked(int $failedCount = 0): bool
    {
        if ($failedCount >= self::BLOCK_FAILED_LOGIN) {
            if (!$this->isIpBlocked()) {
                BlockIp::create([
                    'IP' => request()->ip(),
                    'phone_input' => $this->phone,
                    'hours' => 365 * 24,
                    'end_time' => now()->addYear()->format('Y-m-d H:i:s')
                ]);
            }

            return true;
        }

        return false;
    }

    protected function isIpBlocked(): bool
    {
        return BlockIp::query()
            ->stillBlocked()
            ->where([
                'IP' => request()->ip(),
                'phone_input' => $this->phone,
            ])
            ->count();
    }

    protected function showIpBlockedMessage()
    {
        $this->emit('eventShowDialogMessage', [
            'title' => __('custom::site.login'),
            'message' => __('custom::site.info_messages.ip_blocked_account'),
        ]);
    }

    public function isUserBlocked(): bool
    {
        return (bool)User::query()
            ->where('phone', $this->phone)
            ->value('blocked_ip_id');
    }

    protected function showUserBlockedMessage()
    {
        $this->emit('eventShowDialogMessage', [
            'title' => __('custom::site.login'),
            'message' => __('custom::site.info_messages.user_blocked_account'),
        ]);
    }

    private function tryRecoveryPassword(int $failedCount = 0)
    {
        if ($failedCount >= self::RECOVERY_FAILED_LOGIN) {
            $this->emit('eventSetTargetPhone', [
                'phone' => $this->phone,
                'message' => __('custom::site.info_messages.ip_blocked_recovery_password_prompt'),
            ]);
        }
    }

}
