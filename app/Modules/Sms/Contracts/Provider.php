<?php

namespace App\Modules\Sms\Contracts;

interface Provider {

    /**
     * Send message throw provider
     *
     * @param $to
     * @param $message
     * @param $description
     * @return mixed
     */
    public function sendMessage($to, $message, $description = '');

    /**
     * Send request to get balance
     *
     * @return mixed
     */
    public function getBalance();
}
