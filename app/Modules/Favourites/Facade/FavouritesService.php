<?php

namespace App\Modules\Favourites\Facade;

use App\Modules\Favourites\Contracts\FavouritesContract;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool check(string $code)
 */
class FavouritesService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return FavouritesContract::class;
    }

}
