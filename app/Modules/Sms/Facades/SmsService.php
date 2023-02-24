<?php

namespace App\Modules\Sms\Facades;

use App\Modules\Sms\Contracts\Factory;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Modules\Sms\Contracts\Provider driver(string $driver = null)
 * @see \App\Modules\Sms\SmsServiceManager
 */
class SmsService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }

}
