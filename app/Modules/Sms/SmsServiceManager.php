<?php

namespace App\Modules\Sms;

use App\Modules\Sms\Providers\AbstractProvider;
use App\Modules\Sms\Providers\ESputnikProvider;
use App\Modules\Sms\Providers\SvitSmsProvider;
use App\Modules\Sms\Providers\TurboSmsProvider;
use Illuminate\Support\Manager;
use InvalidArgumentException;

class SmsServiceManager extends Manager
{

    public function getDefaultDriver()
    {
        throw new InvalidArgumentException('No SmsService driver was specified.');
    }

    protected function createSvitsmsDriver()
    {
        $config = $this->config->get('services.svitsms');

        return $this->buildProvider(
            SvitSmsProvider::class, $config
        );
    }

    protected function createESputnikDriver()
    {
        $config = $this->config->get('services.esputnik');

        return $this->buildProvider(
            ESputnikProvider::class, $config
        );
    }

    protected function createTurbosmsDriver()
    {
        $config = $this->config->get('services.turbosms');

        return $this->buildProvider(
            TurboSmsProvider::class, $config
        );
    }

    /**
     * Build an SmsService provider instance.
     *
     * @param  string  $provider
     * @param  array  $config
     * @return AbstractProvider
     */
    public function buildProvider($provider, $config)
    {
        return new $provider($config);
    }

}
