<?php

namespace App\Modules\Favourites;

use App\Modules\Favourites\Contracts\FavouritesContract;
use Illuminate\Support\ServiceProvider;

class FavouritesServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FavouritesContract::class, function(){
            return auth()->check()
                ? new FavouritesByModel()
                : new FavouritesBySession();
        });
    }
}
