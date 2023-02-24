<?php

namespace App\Services\DeliveryServices;

use Illuminate\Support\Facades\Cache;

/**
 * Сервис запросов к API DeliveryAuto службы доставки
 * Кэширует запросы сроком на 1 день
 *
 * @url https://www.delivery-auto.com/uk-UA/Home/APINew
 * v - 1.0.0
 */
class DeliveryAutoService extends BaseDeliveryService
{
    protected $cultureList = ['en' => 'en-US', 'ru' => 'ru-RU', 'uk' => 'uk-UA'];
    protected $country = 1; //Id страны (1-Украина, 2-Россия, null - все)

    /**
     * Возвращает список областей.
     *
     * @return array|mixed
     */
    public function getRegions()
    {
        $response = $this->httpRequest('GetRegionList');

        $items = collect($response['data'] ?? []);

        // Отфильтровываем фиктивные элементы.
        $items = $items->filter(function ($el) {
            return $el['id'] > 0;
        });

        if ($this->shortListAttributes) {
            $items = $items->map(function ($el) {
                return [
                    'ref' => $el['externalId'],
                    'code' => $el['id'],
                    'description' => $el['name'],
                ];
            });
        }

        return $items;
    }

    /**
     * Возвращает список городов по требуемой области или все.
     *
     * @param string $regionId Id отделения по которому нужно вернуть список.
     * @return array|mixed
     */
    public function getCities($regionId = '')
    {
        $params = [
            "regionId" => $regionId,
        ];

        $response = $this->httpRequest('GetAreasList', $params);

        $items = collect($response['data'] ?? []);

        if ($this->shortListAttributes) {
            $items = $items->map(function ($el) {
                return [
                    'ref' => $el['id'],
                    'description' => $el['name'],
                ];
            });
        }

        return $items;
    }

    /**
     * Возвращает весь список отделений.
     *
     * @param string $cityRef Guid города по которому нужно вернуть список.
     * @return array|mixed
     */
    public function getWarehouses($cityRef='')
    {
        $params = [
            "cityId" => $cityRef,
        ];

        $response = $this->httpRequest('GetWarehousesList', $params);

        $items = collect($response['data'] ?? []);

        if ($this->shortListAttributes) {
            $items = $items->map(function ($el) {
                return [
                    'ref' => $el['id'],
                    'description' => $el['name'],
                    'address' => $el['address'],
                ];
            });
        }

        return $items;
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
        $params['culture'] = $this->getCulture();
        $params['country'] = $this->country;

        $queryString = http_build_query($params);
        $url = 'https://www.delivery-auto.com/api/v4/Public/' . $segment;
        if ($queryString) {
            $url .= '?' . $queryString;
        }

        $hash = md5(json_encode(['url' => $url, 'salt' => 'DeliveryAuto',]));
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


    private function getCulture()
    {
        return in_array($this->lang, array_keys($this->cultureList))
            ? $this->cultureList[$this->lang]
            : 'uk-UA';
    }
}
