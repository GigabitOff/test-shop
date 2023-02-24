<?php

namespace App\Providers;

use App\Events\CustomerToLegalInvitationEvent;
use App\Listeners\CustomerToLegalInvitationListener;
use App\Listeners\LogGeoIpLogin;
use App\Listeners\CopyCartWhenLogin;
use App\Listeners\LogoutOtherWhenLogin;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogSuccessfulLogout;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
//            SendEmailVerificationNotification::class,
        ],

        Login::class => [
            CopyCartWhenLogin::class,
            LogSuccessfulLogin::class,
            LogoutOtherWhenLogin::class,
            LogGeoIpLogin::class,

        ],

        Logout::class => [
            LogSuccessfulLogout::class,
        ],

        CustomerToLegalInvitationEvent::class => [
            CustomerToLegalInvitationListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
