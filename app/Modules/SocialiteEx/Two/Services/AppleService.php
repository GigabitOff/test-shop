<?php

namespace App\Modules\SocialiteEx\Two\Services;

/**
 * Founded here
 * @url https://stackoverflow.com/questions/68202279/creating-jwt-after-signing-with-apple-in-php
 */
class AppleService
{
    protected string $keyID = '';
    protected string $teamID = '';
    protected string $clientID = '';
    protected string $privateKeyPath = '';

    public function __construct(
        string $keyID,
        string $teamID,
        string $clientID,
        string $privateKeyPath
    )
    {
        $this->keyID = $keyID;
        $this->teamID = $teamID;
        $this->clientID = $clientID;
        $this->privateKeyPath = $privateKeyPath;
    }

    public function generateJWT() {
        $header = [
            'alg' => 'ES256',
            'kid' => $this->keyID
        ];
        $body = [
            'iss' => $this->teamID,
            'iat' => time(),
            'exp' => time() + 3600,
            'aud' => 'https://appleid.apple.com',
            'sub' => $this->clientID
        ];

        $privKey = openssl_pkey_get_private(file_get_contents($this->privateKeyPath));
        if (!$privKey){
            return false;
        }

        $payload = $this->encode(json_encode($header)).'.'.$this->encode(json_encode($body));

        $signature = '';
        $success = openssl_sign($payload, $signature, $privKey, OPENSSL_ALGO_SHA256);
        if (!$success) return false;

        $raw_signature = $this->fromDER($signature, 64);

        return $payload.'.'.$this->encode($raw_signature);
    }

    private function encode($data){
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }

    private function fromDER(string $der, int $partLength)
    {
        $hex = unpack('H*', $der)[1];
        if ('30' !== mb_substr($hex, 0, 2, '8bit')) { // SEQUENCE
            throw new \RuntimeException();
        }
        if ('81' === mb_substr($hex, 2, 2, '8bit')) { // LENGTH > 128
            $hex = mb_substr($hex, 6, null, '8bit');
        } else {
            $hex = mb_substr($hex, 4, null, '8bit');
        }
        if ('02' !== mb_substr($hex, 0, 2, '8bit')) { // INTEGER
            throw new \RuntimeException();
        }
        $Rl = hexdec(mb_substr($hex, 2, 2, '8bit'));
        $R = $this->retrievePositiveInteger(mb_substr($hex, 4, $Rl * 2, '8bit'));
        $R = str_pad($R, $partLength, '0', STR_PAD_LEFT);
        $hex = mb_substr($hex, 4 + $Rl * 2, null, '8bit');
        if ('02' !== mb_substr($hex, 0, 2, '8bit')) { // INTEGER
            throw new \RuntimeException();
        }
        $Sl = hexdec(mb_substr($hex, 2, 2, '8bit'));
        $S = $this->retrievePositiveInteger(mb_substr($hex, 4, $Sl * 2, '8bit'));
        $S = str_pad($S, $partLength, '0', STR_PAD_LEFT);
        return pack('H*', $R.$S);
    }

    /**
     * @param string $data
     *
     * @return string
     */
    private function preparePositiveInteger(string $data)
    {
        if (mb_substr($data, 0, 2, '8bit') > '7f') {
            return '00'.$data;
        }
        while ('00' === mb_substr($data, 0, 2, '8bit') && mb_substr($data, 2, 2, '8bit') <= '7f') {
            $data = mb_substr($data, 2, null, '8bit');
        }
        return $data;
    }

    /**
     * @param string $data
     *
     * @return string
     */
    private function retrievePositiveInteger(string $data)
    {
        while ('00' === mb_substr($data, 0, 2, '8bit') && mb_substr($data, 2, 2, '8bit') > '7f') {
            $data = mb_substr($data, 2, null, '8bit');
        }
        return $data;
    }

}
