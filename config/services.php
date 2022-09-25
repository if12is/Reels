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
    'google' => [
        'client_id' => '492602080779-92o49s5na11efti6f324pckggeird6vj.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://127.0.0.1:8000/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => '469001788502952', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => '28e904b761f85ea55bfc778e14aaafbb', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'redirect' => 'http://localhost:8000/auth/facebook/callback'
    ],
    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
