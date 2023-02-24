<?php

namespace App\Services\DeliveryServices;

use Illuminate\Support\Facades\Cache;

/**
 * Сервис запросов к API НовойПочты
 * Кэширует запросы сроком на 1 день
 *
 * @url https://devcenter.novaposhta.ua/
 * v - 1.0.0
 */
class NovaPochtaService extends BaseDeliveryService
{

    /**
     * Возвращает список областей.
     *
     * @return array|mixed
     */
    public function getRegions()
    {
        $params = [
            "apiKey" => env('API_KEY_NOVAPOSHTA', null),
            "modelName" => "Address",
            "calledMethod" => "getAreas"
        ];

        $response = $this->httpRequest($params);

        $items = collect($response['data'] ?? []);

        $lang = $this->lang;
        if ($this->shortListAttributes) {
            $items = $items->map(function ($el) use ($lang) {
                return [
                    'ref' => $el['Ref'],
                    'description' => ('ru' === $lang) ? $el['DescriptionRu'] : $el['Description'],
                ];
            });
        }

        return $items;
    }

    /**
     * Возвращает список городов по требуемому региону или все.
     *
     * @param string $regionRef Guid региона по которому нужно вернуть список.
     * @return array|mixed
     */
    public function getCities($regionRef = '')
    {
        $params = [
            "apiKey" => env('API_KEY_NOVAPOSHTA', null),
            "modelName" => "Address",
            "calledMethod" => "getCities"
        ];

        $response = $this->httpRequest($params);

        $items = collect($response['data'] ?? []);

        if ($regionRef) {
            $items = $items->filter(function ($el) use ($regionRef) {
                return $el['Area'] === $regionRef;
            });
        }

        $lang = $this->lang;

        if ($this->shortListAttributes) {
            $items = $items->map(function ($el) use ($lang) {
                return [
                    'ref' => $el['Ref'],
                    'description' => ('ru' === $lang) ? $el['DescriptionRu'] : $el['Description'],
                ];
            });
        }

        return $items;
    }

    /**
     * Возвращает список отделений по требуемому населенному пункту.
     *
     * @param string $cityRef Id нас. пункта по которому нужно вернуть список.
     * @return array|mixed
     */
    public function getWarehouses($cityRef = '')
    {
        $params = [
            "apiKey" => env('API_KEY_NOVAPOSHTA', null),
            "modelName" => "AddressGeneral",
            "calledMethod" => "getWarehouses",
            "methodProperties" => [
                "CityRef" => $cityRef
            ]
        ];

        $response = $this->httpRequest($params);

        $items = collect($response['data'] ?? []);

        $lang = $this->lang;

        if ($this->shortListAttributes) {
            $items = $items->map(function ($el) use ($lang) {
                return [
                    'ref' => $el['Ref'],
                    'code' => $el['SiteKey'],
                    'number' => $el['Number'],
                    'description' => ('ru' === $lang) ? $el['DescriptionRu'] : $el['Description'],
                ];
            });
        }

        return $items;
    }

    private function httpRequest($params)
    {

        $hash = md5(json_encode(array_merge($params, ['salt' => 'NovaPochta'])));
        $result = Cache::get($hash, []);

        if (!$result) {
            try {
                $client = new \GuzzleHttp\Client();

                $response = $client->request('POST', 'https://api.novaposhta.ua/v2.0/json/', [
                    'headers' => [
                        'Content-Type' => "application/json",
                        'Accept' => "application/json"
                    ],
                    'body' => json_encode($params),
                ]);

                $result = json_decode((string)$response->getBody(), true);
                Cache::put($hash, $result, now()->addDays(1));
            } catch (\Exception $e) {
            }
        }

        return $result ?? [];
    }

}
