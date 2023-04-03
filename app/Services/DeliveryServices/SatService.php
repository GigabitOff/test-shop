<?php

namespace App\Services\DeliveryServices;

use Illuminate\Support\Facades\Cache;

/**
 * Сервис запросов к API SAT службы доставки
 * Кэширует запросы сроком на 1 день
 *
 * @url https://www.sat.ua/api/methods/main/
 * v - 1.0.0
 */
class SatService extends BaseDeliveryService
{

    /**
     * Возвращает список городов по требуемому отделению или все.
     *
     * @param string $warehouseRef Guid отделения по которому нужно вернуть список.
     * @return array|mixed
     */
    public function getCities($warehouseRef = '')
    {


        $response = $this->httpRequest('getRsp', ['rsp' => $warehouseRef]);

        $items = collect($response['data'] ?? []);

        if ($this->shortListAttributes) {
            $items = $items->map(function ($el) {
                return [
                    'ref' => $el['ref'],
                    'description' => $el['description'],
                ];
            });
        }

        return $items;
    }

    /**
     * Возвращает весь список отделений.
     *
     * @return array|mixed
     */
    public function getWarehouses()
    {
        $response = $this->httpRequest('getRsp');

        $items = collect($response['data'] ?? []);

        if ($this->shortListAttributes) {
            $items = $items->map(function ($el) {
                return [
                    'ref' => $el['ref'],
                    'description' => $el['description'],
                    'address' => $el['address'],
                    'number' => $el['number'],
                ];
            });
        }

        return $items;
    }



    public function getStreet($city)
    {

        $response = $this->httpRequest('getRsp', [
            'searchstring' => $city, // добавляем параметр для поиска по городу
        ]);

        $items = collect($response['data'] ?? []);

        if ($this->shortListAttributes) {
            $items = $items->map(function ($el) {
                return [
                    'address' => $el['address'], // изменение возвращаемых атрибутов
                ];
            });
        }

        return $items; // возвращаем только адреса

    }

    /**
     * Выполняет http запросы на API
     *
     * @param string $segment Сегмент адреса
     * @param array $params Дополнительные парамтеры
     * @return array|mixed
     */
    private function httpRequest($segment, $params = [])
    {
        $params['language'] = $this->getLanguage();
        $queryString = http_build_query($params);
        $url = 'https://api.sat.ua/study/hs/api/v1.0/main/json/' . $segment;
        if ($queryString){
            $url .= '?' . $queryString;
        }

        $hash = md5(json_encode(['url' => $url, 'salt' => 'SAT',]));
        $result = Cache::get($hash, []);

        if (!$result) {
            try {

                $client = new \GuzzleHttp\Client();

                $response = $client->request('GET', $url, [
                    'headers' => [
                        'Content-Type' => "application/json",
                        'Accept' => "application/json"
                    ],
                ]);

                $result = json_decode((string)$response->getBody(), true);

                Cache::put($hash, $result, now()->addDays(1));
            } catch (\Exception $e) {
            }
        }

        return $result ?? [];
    }

    private function getLanguage()
    {
        return in_array($this->lang, ['ru', 'en', 'uk']) ? $this->lang : 'uk';
    }

}
