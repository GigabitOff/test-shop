<?php

namespace App\Http\Controllers;

use App\Services\AuthProvidersService;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

/**
 * Контроллер провайдеров услуг аутентификации.
 */
class AuthProvidersController extends Controller
{
    protected AuthProvidersService $providerService;

    public function __construct(AuthProvidersService $service)
    {
        return $this->providerService = $service;
    }

    public function googleAuthLogin()
    {
        return $this->providerRedirect('google');
    }

    public function appleAuthLogin()
    {
        return $this->providerRedirect('apple');
    }

    public function diiaAuthLogin()
    {
        return $this->providerRedirect('diia');
    }

    public function bankidAuthLogin()
    {
        return $this->providerRedirect('bankid');
    }

    /**
     * Аутентификация через систему GoogleID
     */
    public function googleAuthCallback()
    {
        return $this->providerCallback('google');
    }

    /**
     * Аутентификация через систему AppleID
     */
    public function appleAuthCallback()
    {
        return $this->providerCallback('apple');
    }

    /**
     * Аутентификация через систему Дія
     */
    public function diiaAuthCallback()
    {
        return $this->providerCallback('diia');
    }

    /**
     * Аутентификация через систему БанкID
     */
    public function bankidAuthCallback()
    {
        return $this->providerCallback('bankid');
    }

    /**
     * Запрос на аутентификацию через провайдера
     *
     * @param string $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function providerRedirect(string $provider)
    {
        Session::put('intended', url()->previous());
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Получение пользователя и выполнение аутентификации
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function providerCallback(string $provider)
    {
        $intended = Session::pull('intended', '/');
        try {
            $sUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            logger("googleAuthCallback.error: {$e->getMessage()}");
            return redirect()->to($intended)->with('show_message_popup', 'provider_auth_error');
        }

        if (in_array($provider, ['diia', 'bankid'])) {
            $user = $this->providerService->newOrUpdateLegalUser($sUser);
        } else {
            $user = $this->providerService->newOrUpdateSimpleUser($sUser);
        }

        auth()->login($user, true);

        $intended = Session::pull('intended', '/');
        if (!$user->isRegistrationCompleted()){
            return redirect()->to($intended)->with('show_message_popup', 'do_complete_registration');
        }
        return redirect()->to($intended);
    }


}
