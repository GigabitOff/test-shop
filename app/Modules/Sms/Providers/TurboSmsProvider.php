<?php

namespace App\Modules\Sms\Providers;

use GuzzleHttp\Client;

class TurboSmsProvider extends AbstractProvider
{
    protected $endpoint = 'https://api.turbosms.ua';

    public function __construct($config)
    {
        $this->client = new Client(['base_uri' => $this->endpoint, 'verify' => false]);

        parent::__construct($config);
    }

    protected function createHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => "Basic {$this->key}",
        ];
    }

    public function sendMessage($to, $message, $description = '')
    {
        if ($this->out_log){
            logger('SendMessage: ', ['recipients' => (array)$to, 'message' => $message]);
        }

        if (!$this->out_provider){
            logger('TurboSms: Target provider disabled.');
            return 'Target disabled.';
        }

        $body = [
            'sender' => $this->alfa,
            'recipients' => (array)$to,
            'sms' => [
                'text' => $message,
            ],
            // 'viber' => [
            //     'text' => $message,
            // ]
        ];

        try {
            $response = $this->client->post('message/send.json', [
                'headers' => $this->createHeaders(),
                'body' => json_encode($body),
            ]);

            $content = json_decode($response->getBody()->getContents());

            if ($content
                && $content->response_code >= 800
                && $content->response_code <= 899)
            {
                return 'OK';
            } else {
                logger('TurboSmsError: ', ['args' => func_get_args(), 'response' => (array)$content]);
            }
        } catch (\Exception $e) {
            logger('TurboSmsError: ' . $e->getMessage(), $e->getTrace());
            return false;
        }

        return false;
    }

    public function getBalance()
    {
        try {
            $response = $this->client->get('user/balance.json', [
                'headers' => $this->createHeaders(),
            ]);

            $content = json_decode($response->getBody()->getContents());

            if ($content && 'OK' === $content->response_status) {
                return $content->response_result->balance;
            } else {
                logger('TurboSmsError: ', ['args' => func_get_args(), 'response' => (array)$content]);
            }
        } catch (\Exception $e) {
            logger('TurboSmsError: ' . $e->getMessage(), $e->getTrace());
            return false;
        }

        return false;
    }
}
