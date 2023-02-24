<?php

namespace App\Modules\Cart\Facade;

use App\Modules\Cart\Contracts\CartContract;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool check(string $code)
 */
class CartService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CartContract::class;
    }

}
