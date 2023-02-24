<?php

namespace App\Modules\Localization;


use Illuminate\Support\ServiceProvider;

class LocalizationServiceProvider extends ServiceProvider
{
    public function register() {
        $this->app->singleton("Localization", Localization::class);
    }
}
