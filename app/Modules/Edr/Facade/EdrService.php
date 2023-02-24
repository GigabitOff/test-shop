<?php

namespace App\Modules\Edr\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool check(string $code)
 */
class EdrService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'EdrService';
    }

}
