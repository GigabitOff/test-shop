<?php

namespace App\Modules\Sms\Providers;

use App\Modules\Sms\Contracts\Provider as ProviderContract;

abstract class AbstractProvider implements ProviderContract
{
    protected $data;

    public function __construct($config)
    {
        $this->data = $config;
    }

    public function __get($name)
    {
        if (isset($this->data[$name])){
            return $this->data[$name];
        }
        return null;
    }
}
