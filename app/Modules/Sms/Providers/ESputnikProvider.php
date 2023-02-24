<?php

namespace App\Modules\Sms\Providers;

use GuzzleHttp\Client;

/**
 * Сервис работы со службой ESputnik
 *
 * @url https://docs.esputnik.com/reference/sendsms-1
 */
class ESputnikProvider extends AbstractProvider
{
    protected $endpoint = 'https://esputnik.com/api/v1/';

    public function __construct($config)
    {
        $this->client = new Client(['base_uri' => $this->endpoint, 'verify' => false]);

        parent::__construct($config);
    }

    protected function createHeaders(): array
    {
        $code = base64_encode("web_{$this->alfa}:{$this->key}");

        return [
            'Accept' => 'application/json; charset=UTF-8',
            'Content-Type' => 'application/json',
            'Authorization' => "Basic {$code}",
        ];
    }

    public function sendMessage($to, $message, $description = '')
    {
        $body = [
            'from' => $this->alfa,
            'text' => $message,
            'phoneNumbers' => (array)$to,
        ];

        try {
            $response = $this->client->post('message/sms', [
                'headers' => $this->createHeaders(),
                'body' => json_encode($body),
            ]);

            $content = json_decode($response->getBody()->getContents());

            if ($content && 'OK' === $content->results->status) {
                return $content->results->requestId;
            } else {
                logger('ESputnikError: ' . $content, func_get_args());
            }
        } catch (\Exception $e) {
            logger('ESputnikError' . $e->getMessage(), $e->getTrace());
            return false;
        }

        return false;
    }

    public function getBalance()
    {
        try {
            $response = $this->client->get('balance', [
                'headers' => $this->createHeaders(),
            ]);

            $content = json_decode($response->getBody()->getContents());

            if ($content && isset($content->currentBalance)) {
                return $content->currentBalance;
            } else {
                logger('ESputnikError: ' . $content, func_get_args());
            }
        } catch (\Exception $e) {
            logger('ESputnikError' . $e->getMessage(), $e->getTrace());
            return false;
        }

        return false;
    }
}
