<?php

namespace App\Modules\Cart;

use App\Modules\Cart\Contracts\CartContract;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CartContract::class, function(){
            return auth()->check()
                ? new CartByModel()
                : new CartBySession();
        });
    }
}
