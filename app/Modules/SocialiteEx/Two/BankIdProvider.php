<?php

namespace App\Modules\SocialiteEx\Two;

use Illuminate\Support\Arr;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class BankIdProvider extends AbstractProvider implements ProviderInterface
{

    /**
     * Сертификат закодированный в base64
     * @var string
     */
    protected $cert_base64;

    /**
     * Список запрашиваемых полей данных пользователя.
     *
     * @var array
     */
    protected $user_fields = [
        'firstName', // имя
        'middleName', // отчество
        'lastName', // фамилия
        'phone', // актуальный телефон
        'inn', // идентификационный номер налогоплательщика
//        'clId', // идентификатор клиента (необязательное поле и может отсутствовать)
//        'clIdText', // статических текст подтверждения выдачи информации <Передана інформація є достовірною і підтверджена BankID   dd.MM.yyyy   HH:mm>
//        'birthDay', // дата рождения
//        'sex', // пол (M - мужской, F - женский)
        'email', // email
//        'resident', // определение резидентности (стандарт ISO(2)) UA — резидент,    /UA — нерезидент
//        'dateModification', // последняя дата модификации данных в объекте (dd.MM.yyyy HH:mm:ss.S)
    ];

    /**
     * Список запрашиваемых полей адресов пользователя.
     *
     * @var array
     */
    protected $user_addresses_fields = [
//        'country', // страна
//        'state', // область
//        'area', // район
        'city', // город
//        'subTown', // микрорайон/жилмассив и пр. в городе
//        'street', // улица
//        'houseNo', // номер дома
//        'flatNo', // номер квартиры
    ];

    public function setCertificate($cert_base64)
    {
        $this->cert_base64 = $cert_base64;
    }

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://{IP:port}/DataAccessService/das/authorize', $state);
//        return $this->buildAuthUrlFromBase('http://laravel.test.auth/sendauth/bankid/auth', $state);
    }

    protected function getTokenUrl()
    {
        return 'https://{IP:port}/DataAccessService/oauth/token';
//        return 'http://laravel.test.auth/sendauth/bankid/get-access-token';
    }

    protected function mapUserToObject(array $user)
    {
        // Все что есть в $user будет сохранено в объекте User.

        $name = implode(' ',[
            Arr::get($user, 'customer.firstName'),
            Arr::get($user, 'customer.middleName'),
            Arr::get($user, 'customer.lastName')
        ]);
        return (new User)->setRaw($user)->map([
            // Тут просто переименовываем и добавляем значения которые нам нужны
            'name' => $name,
            'city' => Arr::get($user, 'addresses.city'),
            'inn' => Arr::get($user, 'customer.inn'),
            'email' => Arr::get($user, 'customer.email'),
            'phone' => Arr::get($user, 'customer.phone'),
            'avatar' => null,
        ]);
    }

    /**
     * Get the GET parameters for the code request.
     *
     * @param  string|null  $state
     * @return array
     */
    protected function getCodeFields($state = null)
    {
        $fields = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUrl,
            'response_type' => 'code',
        ];

        if ($this->usesState()) {
            $fields['state'] = $state;
        }

        return array_merge($fields, $this->parameters);
    }

    /**
     * Get the access token response for the given code.
     *
     * @param  string  $code
     * @return array
     */
    public function getAccessTokenResponse($code)
    {
        $new_secret = $this->clientId . $this->clientSecret . $code;
        $this->clientSecret = hash('sha512', $new_secret);

        $response = $this->getHttpClient()
            ->post($this->getTokenUrl(), [
                'headers' => [
                    'Accept'     => 'application/json',
                ],
                'form_params' => [], // $this->getTokenFields($code)
            ]);

        $data = json_decode($response->getBody(), true);

        if ('invalid_grant' === Arr::get($data, 'error')){
            throw new InvalidStateException("BankIDProvider.getAccessTokenResponse error with message:{$data['error_description']}");
        }
        return $data;
    }

    protected function getUserByToken($token_data)
    {
        [$token, $user_id] = json_decode($token_data, true);

        $response = $this->getHttpClient()->post('https://{IP:port}/ResourceService/checked/data', [
//        $response = $this->getHttpClient()->post('http://laravel.test.auth/sendauth/bankid/get-user-info', [
            'json' => [
                'type' => 'physical',
                'fields' => implode(',', $this->user_fields),
                'addresses' => [
                    'type' => 'factual',    // тип адреса: juridical — адрес регистрации (штамп в паспорте); factual — адрес фактический (реально проживает); birth – адрес рождения
                    'fields' => implode(',', $this->user_addresses_fields),
                ]
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$token},{$this->clientId}",
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if ('err' === $data['state']){
            throw new InvalidStateException("BankIDProvider.getUserByToken error with code:{$data['code']} and message:{$data['desc']}");
        }

        return $data;
    }


}
