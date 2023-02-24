<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_AUTH_CLIENT_ID'),
        'client_secret' => env('GOOGLE_AUTH_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_AUTH_CLIENT_CALLBACK'),
    ],

    'apple' => [
        'client_id' => env('APPLE_AUTH_CLIENT_ID'),
        'client_secret' => env('APPLE_AUTH_CLIENT_SECRET'),
        'redirect' => env('APPLE_AUTH_CLIENT_CALLBACK'),
    ],

    'diia' => [
        'client_id' => env('DIIA_AUTH_CLIENT_ID'),
        'client_secret' => env('DIIA_AUTH_CLIENT_SECRET'),
        'redirect' => env('DIIA_AUTH_CLIENT_CALLBACK'),
        'use_sandbox' => env('DIIA_AUTH_USE_SANDBOX', false),
        'sandbox_uri' => 'https://api2s.diia.gov.ua',
        'guzzle' => [
            'base_uri' => 'https://api2.diia.gov.ua',
        ],
    ],

    'bankid' => [
        'client_id' => env('BANKID_AUTH_CLIENT_ID'),
        'client_secret' => env('BANKID_AUTH_CLIENT_SECRET'),
        'redirect' => env('BANKID_AUTH_CLIENT_CALLBACK'),
    ],

    'svitsms' => [
        'user' => env('SVITSMS_USER'),
        'password' => env('SVITSMS_PASSWORD'),
        'alfa' => env('SVITSMS_ALFA'),
    ],

    'turbosms' => [
        'key' => env('TURBOSMS_KEY'),
        'alfa' => env('TURBOSMS_ALFA'),
        // Куда разрешено отправлять log, provider,
        'out_log' => env('TURBOSMS_OUT_LOG_ENABLED', false),
        'out_provider' => env('TURBOSMS_OUT_PROVIDER_ENABLED', false),
    ],

    'edr' => [
        'token' => env('EDR_TOKEN'),
        'host' => env('EDR_HOST'),
        'enabled' => env('EDR_ENABLED', true),
    ],
];
