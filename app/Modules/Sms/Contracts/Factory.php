<?php

namespace App\Modules\Sms\Contracts;

use App\Modules\Sms\Contracts\Provider;

interface Factory
{
    /**
     * Get an SmsProvider implementation.
     *
     * @param  string  $driver
     * @return Provider
     */
    public function driver($driver = null);
}
