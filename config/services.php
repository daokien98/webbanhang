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
        'client_id' => '1288143318192311',  //client face của bạn
        'client_secret' => 'd02396cb4d0af80facd52379542b5a0b',  //client app service face của bạn
        'redirect' => 'http://localhost/laravel/trang-chu' //callback trả về
    ],

    'google' => [
        'client_id' => '836703543327-kqu7jk2qmac0um090s2t3u8msn815cjr.apps.googleusercontent.com',
        'client_secret' => 'WXsjJbt9fWMpvIhMgXiLdMe-',
        'redirect' => 'http://localhost/laravel/google/callback'
    ],

];
