<?php

namespace App\Modules\SocialiteEx\Two;

use App\Modules\SocialiteEx\Two\Services\AppleService;
use Illuminate\Support\Arr;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class AppleProvider extends AbstractProvider implements ProviderInterface
{
    protected $encodingType = PHP_QUERY_RFC3986;
    protected $scopeSeparator = " ";

    protected string $keyId = '';
    protected string $teamId = '';
    protected string $privateKeyFileName = '';

    protected $scopes = ['name', 'email'];

    public function setKeyID(string $id)
    {
        $this->keyId = $id;
        return $this;
    }

    public function setTeamID(string $id)
    {
        $this->teamId = $id;
        return $this;
    }

    public function setPrivateKeyFileName(string $name)
    {
        $this->privateKeyFileName = $name;
        return $this;
    }

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://appleid.apple.com/auth/authorize', $state);
    }

    protected function getCodeFields($state = null)
    {
        $fields = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUrl,
            'scope' => $this->formatScopes($this->getScopes(), $this->scopeSeparator),
            'response_type' => 'code',
            'response_mode' => 'form_post',
        ];

        if ($this->usesState()) {
            $fields['state'] = $state;
        }

        return array_merge($fields, $this->parameters);
    }

    protected function getTokenUrl()
    {
        return "https://appleid.apple.com/auth/token";
    }

    protected function getTokenFields($code)
    {
        $privateKeyPath = $this->privateKeyFileName
            ? base_path($this->privateKeyFileName)
            : '';

        $service = new AppleService($this->keyId, $this->teamId, $this->clientId, $privateKeyPath);
        $fields = parent::getTokenFields($code);
        $fields["grant_type"] = "authorization_code";
        $fields["client_secret"] = $service->generateJWT();

        return $fields;
    }

    protected function getUserByToken($token)
    {
        $claims = explode('.', $token)[1];

        return json_decode(base64_decode($claims), true);
    }

    public function user()
    {
        $response = $this->getAccessTokenResponse($this->getCode());

        $user = $this->mapUserToObject(
            $this->getUserByToken(
                Arr::get($response, 'id_token')
            )
        );

        return $user
            ->setToken(Arr::get($response, 'id_token'))
            ->setRefreshToken(Arr::get($response, 'refresh_token'))
            ->setExpiresIn(Arr::get($response, 'expires_in'));
    }

    protected function mapUserToObject(array $user)
    {
        if (request()->filled("user")) {
            $userRequest = json_decode(request("user"), true);

            if (array_key_exists("name", $userRequest)) {
                $user["name"] = $userRequest["name"];
                $fullName = trim(
                    ($user["name"]['firstName'] ?? "")
                    . " "
                    . ($user["name"]['lastName'] ?? "")
                );
            }
        }

        return (new User)
            ->setRaw($user)
            ->map([
                "id" => $user["sub"],
                "name" => $fullName ?? null,
                "email" => $user["email"] ?? null,
            ]);
    }

}
