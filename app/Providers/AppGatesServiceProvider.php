<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppGatesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /** for Customers */

        Gate::define('asCustomer', function ($user) {
            return $user->isCustomer;
        });
        Gate::define('asCustomerUnregistered', function ($user) {
            return $user->isCustomerUnregistered;
        });
        Gate::define('asCustomerRegistered', function ($user) {
            return $user->isCustomerRegistered;
        });
        Gate::define('asCustomerSimple', function ($user) {
            return $user->isCustomerSimple;
        });
        Gate::define('asCustomerLegal', function ($user) {
            return $user->isCustomerLegal;
        });
        Gate::define('asCustomerLegalAdmin', function ($user) {
            return $user->isCustomerLegalAdmin;
        });
        Gate::define('asCustomerLegalUser', function ($user) {
            return $user->isCustomerLegalUser;
        });


        /** for Employees */

        Gate::define('asEmployee', function ($user) {
            return $user->isEmployee;
        });
        Gate::define('asSiteAdmin', function ($user) {
            return $user->isSiteAdmin;
        });
        Gate::define('asDirector', function ($user) {
            return $user->isDirector;
        });
        Gate::define('asManager', function ($user) {
            return $user->isManager;
        });
        Gate::define('asHeadManager', function ($user) {
            return $user->isHeadManager;
        });
        Gate::define('asApiManager', function ($user) {
            return $user->isApiManager;
        });
    }
}
