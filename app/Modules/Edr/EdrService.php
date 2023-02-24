<?php

namespace App\Modules\Edr;

use GuzzleHttp\Client;

class EdrService
{
    protected $http;
    protected $token;
    protected $enabled;

    public function __construct()
    {
        $config = config('services.edr');
        $this->enabled = $config['enabled'];
        $this->token = $config['token'];

        if ($this->enabled) {
            $this->http = new Client(['base_uri' => $config['host']]);
        }
    }

    public function check($code)
    {
        if (!$this->enabled) {
            logger('EdrService is disabled. Please check your .env file.');
            return true;
        }

        // curl -X GET --header "Accept: application/json" --header "Authorization: Token e43ede2de86ea2900174ed6961dbe770045dc389" "https://zqedr-api.nais.gov.ua/1.0/subjects?code=2768215255"
        $response = $this->http->get('/1.0/subjects', [
            'query' => [
                'code' => $code,
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Token ' . $this->token,
            ],
            'http_errors' => false,
        ]);

        if ($response->getStatusCode() === 200){
            $founded = json_decode($response->getBody(), true);

            return count($founded);
        } else {
            logger('EdrService code: ' . $response->getStatusCode());
            logger('EdrService error: '. $response->getBody());
        }

        return false;
    }
}
