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
    'facebook' => [
        'client_id' => '391401119062608',
        'client_secret' => '58bcad618179bc92e040efc55e22a3a8',
        'redirect' => 'https://khanhnguyen19c.gov.com/E-Commerce/public/auth/facebook/callback',
    ],
    'google' => [
        'client_id' => '440481710229-inimbscsks6d167urjlqm1706bjvlgia.apps.googleusercontent.com',
        'client_secret' => 'ltc0-fs4LAETMduhRQWdyKD3',
        'redirect' => 'http://127.0.0.1:8000/auth/google/callback',
],
];
