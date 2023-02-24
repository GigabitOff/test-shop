<?php

namespace App\Modules\SocialiteEx\Two;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

/**
 * Докумендация о подключении
 * @url https://docs.google.com/document/d/1QtmsJ0WoHEqM6dP3sOEjep_g43o-uR8sqkjC1qxX2u8/edit#
 */
class DiiaProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * The separating character for the requested scopes.
     *
     * @var string
     */
    protected $scopeSeparator = ',';

    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = [
        'dig_sign',
        'bank_id',
        'diia_id',
    ];

    /**
     * Список запрашиваемых полей данных пользователя.
     *
     * @var array
     */
    protected $user_fields = [
//        'issuer',   // Реквізити видавника сертифіката (Надавач)
//        'issuercn', // Загальне ім’я Надавача
//        'serial',   // Реєстраційний номер сертифіката у Надавача
//        'subject',  // Реквізити власника сертифіката (користувача)
        'subjectcn',    // Загальне ім’я користувача
        'locality', // Місто (населений пункт) користувача
        'state',    // Область (регіон) користувача
        'o',    // Найменування організації користувача
//        'ou',   // Назва підрозділу організації користувача
        'title',    // Посада користувача
        'givenname',    // Ім’я користувача
        'middlename',   // По батькові користувача
        'lastname', // Прізвище користувача
        'email',    // Адреса ел. пошти (e-mail) користувача
//        'address',  // Адреса (фізична) користувача
        'phone',    // Телефон користувача
//        'dns',  // DNS-ім'я користувача
        'edrpoucode', // Код за ЄДРПОУ користувача
//        /**
//         * РНОКПП користувача або серія (за наявності) та номер паспорта (для
//         * користувачів, які через свої релігійні переконання відмовляються від
//         * прийняття реєстраційного номера облікової картки платника податків
//         * та офіційно повідомили про це відповідний контролюючий орган і
//         * мають відмітку у паспорті) (Додаток А, п. 8)
//         */
        'drfocode',
//        'unzr',     // Унікальний номер запису в Єдиному демографічному реєстрі
    ];

    public function getRedirectData(): array
    {
        return $this->getAuthUrl('');
    }

    protected function getAuthUrl($state): array
    {
        // Этап 1 - получение сессионного токена.
        $sessionToken = $this->getSessionToken();

        // Этап 2 - получение branchID.
        $branchId = $this->getBranchId($sessionToken);

        // Этап 3 - получение offerUUID.
        $offerUUID = $this->getOfferUUID($sessionToken, $branchId);

        // Этап 4 - получение redirectUrl для приложения Дия.
        $uuid = str_replace('-', '', Str::uuid());
        $requestId = base64_encode($uuid);
        $redirectUrl = $this->getDeepLink($sessionToken, $branchId, $offerUUID, $requestId);

        return [
            'branchId' => $branchId,
            'offer_uuid' => $offerUUID,
            'request_id' => $requestId,
            'url' => $redirectUrl,
        ];
    }

    protected function getSessionToken(): string
    {
        $url = '/api/v1/auth/acquirer/';
        $response = $this->getHttpClient()->get($url . $this->clientId, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic '. $this->clientSecret,
            ],
        ]);

        return json_decode($response->getBody())->token ?? '';
    }

    protected function getBranchId(string $token): string
    {
        $url = '/api/v2/acquirers/branch';
        $response = $this->getHttpClient()->post($url, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. $token,
            ],
            'json' => [
                'name' => 'TeemBranch',
                'location' => 'Одесса',
                'street' => 'Инглези',
                'house' => '20',
                'deliveryTypes' => ['api'],
                'offerRequestType' => 'dynamic',
                'scopes' => [
                    'diiaId' => [
                        'auth'
                    ]
                ]
            ],
        ]);

        return json_decode($response->getBody())->_id ?? '';
    }

    protected function getOfferUUID(string $token, string $branchId): string
    {
        $url = "/api/v1/acquirers/branch/{$branchId}/offer";
        $response = $this->getHttpClient()->post($url, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. $token,
            ],
            'json' => [
                'name' => 'TeemOffer',
                'scopes' => [
                    'diiaId' => [
                        'auth'
                    ]
                ]
            ],
        ]);

        return json_decode($response->getBody())->_id ?? '';
    }

    protected function getDeepLink(string $token, string $branchId, string $offerUUID, string $requestId): string
    {
        $url = "/api/v2/acquirers/branch/{$branchId}/offer-request/dynamic";
        $response = $this->getHttpClient()->post($url, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. $token,
            ],
            'json' => [
                'offerId' => $offerUUID,
                'requestId' => $requestId,
                'returnLink' => $this->redirectUrl,
            ],
        ]);

        return json_decode($response->getBody())->deeplink ?? '';
    }

    protected function getTokenUrl()
    {
        return 'https://id.gov.ua/get-access-token';
//        return 'http://laravel.test.auth/sendauth/diia/get-access-token';
    }

    protected function getUserByToken($token_data)
    {
        [$token, $user_id] = json_decode($token_data, true);

        $response = $this->getHttpClient()->get('https://id.gov.ua/get-user-info', [
//        $response = $this->getHttpClient()->get('http://laravel.test.auth/sendauth/diia/get-user-info', [
            'query' => [
                'user_id' => $user_id,
                'access_token' => $token,
                'fields' => implode(',', $this->user_fields),
                'cert' => $this->cert_base64,
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    protected function mapUserToObject(array $user)
    {
        // Все что есть в $user будет сохранено в объекте User.

        return (new User)->setRaw($user)->map([
            // Тут просто переименовываем и добавляем значения которые нам нужны
            'id' => Arr::get($user, 'user_id'),
            'name' => Arr::get($user, 'subjectcn'),
            'city' => Arr::get($user, 'locality'),
            'company' => Arr::get($user, 'o'),
            'okpo' => Arr::get($user, 'edrpoucode'),
            'inn' => Arr::get($user, 'drfocode'),
            'position' => Arr::get($user, 'title'),
            'email' => Arr::get($user, 'email'),
            'phone' => Arr::get($user, 'phone'),
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
            'auth_type' => $this->formatScopes($this->getScopes(), $this->scopeSeparator),
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
        $response = $this->getHttpClient()
            ->get($this->getTokenUrl(), [
                'headers' => [
                    'Accept'     => 'application/json',
                ],
                'query' => $this->getTokenFields($code)
            ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function user()
    {
        if ($this->user) {
            return $this->user;
        }

        if ($this->hasInvalidState()) {
            throw new InvalidStateException;
        }

        $response = $this->getAccessTokenResponse($this->getCode());

        $token = Arr::get($response, 'access_token');
        $user_id = Arr::get($response, 'user_id');

        // Что-бы подстроится под интрефейс AbstractProvider
        // пришлось обернуть в аргумент "токен" json строку
        $this->user = $this->mapUserToObject($this->getUserByToken(
            json_encode([$token, $user_id])
        ));

        return $this->user->setToken($token)
            ->setRefreshToken(Arr::get($response, 'refresh_token'))
            ->setExpiresIn(Arr::get($response, 'expires_in'));
    }

}
