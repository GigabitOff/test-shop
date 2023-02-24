<?php

namespace App\Modules\Comparisons;

use App\Modules\Comparisons\Contracts\ComparisonsContract;
use Illuminate\Support\ServiceProvider;

class ComparisonsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ComparisonsContract::class, function(){
            return auth()->check()
                ? new ComparisonsByModel()
                : new ComparisonsBySession();
        });
    }
}
