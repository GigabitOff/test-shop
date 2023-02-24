<?php

namespace App\Modules\Comparisons\Facade;

use App\Modules\Comparisons\Contracts\ComparisonsContract;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool check(string $code)
 */
class ComparisonsService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ComparisonsContract::class;
    }

}
