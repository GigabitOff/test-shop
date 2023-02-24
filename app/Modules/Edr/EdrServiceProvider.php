<?php

namespace App\Modules\Edr;

use Illuminate\Support\ServiceProvider;

class EdrServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('EdrService', EdrService::class);
    }
}
