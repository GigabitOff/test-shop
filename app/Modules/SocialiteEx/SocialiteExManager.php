<?php

namespace App\Modules\SocialiteEx;

use App\Modules\SocialiteEx\Two\AppleProvider;
use App\Modules\SocialiteEx\Two\BankIdProvider;
use App\Modules\SocialiteEx\Two\DiiaProvider;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\AbstractProvider;

class SocialiteExManager extends SocialiteManager
{
    /**
     * Create an instance of the specified driver.
     *
     * @return AbstractProvider
     */
    protected function createDiiaDriver(): AbstractProvider
    {
        $config = $this->config->get('services.diia');

        if ($config['use_sandbox']){
            $config['guzzle']['base_uri'] = $config['sandbox_uri'];
        }

        return $this->buildProvider(
            DiiaProvider::class,
            $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return AbstractProvider
     */
    protected function createBankidDriver(): AbstractProvider
    {
        $config = $this->config->get('services.bankid');

        return $this->buildProvider(
            BankIdProvider::class,
            $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return AbstractProvider
     */
    protected function createAppleDriver(): AbstractProvider
    {
        $config = $this->config->get('services.apple');
        $config['client_secret'] = '';  // Not used. Only for compatible.

        return $this->buildProvider(AppleProvider::class, $config)
            ->setKeyID($config['key_id'] ?? '')
            ->setTeamID($config['team_id'] ?? '')
            ->setPrivateKeyFileName($config['private_key_file_name'] ?? '');
    }

}
