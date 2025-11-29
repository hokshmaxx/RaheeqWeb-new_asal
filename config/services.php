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

    'tap' => [
        'secret_key' => env('TAP_SECRET_KEY'),
        'publishable_key' => env('TAP_PUBLISHABLE_KEY'),
        'webhook_secret' => env('TAP_WEBHOOK_SECRET'),
        'mode' => env('TAP_MODE', 'test'), // test or live
    ],

    'omniful' => [
        'base_url' => env('OMNIFUL_BASE_URL', 'https://prodapi.omniful.com'),
        'access_token' => env('OMNIFUL_ACCESS_TOKEN'),
        'webhook_secret' => env('OMNIFUL_WEBHOOK_SECRET'),
        'hub_code' => env('OMNIFUL_HUB_CODE', 'A1'),
        'country' => env('OMNIFUL_COUNTRY', 'Saudi Arabia'),
        'country_code' => env('OMNIFUL_COUNTRY_CODE', 'KW'),
        'currency' => env('OMNIFUL_CURRENCY', 'SAR'),
    ],


];
