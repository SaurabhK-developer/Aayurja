<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],
    'recaptcha' => [
    'siteKey' => env('GOOGLE_RECAPTCHA_KEY'),
    'secretKey' => env('GOOGLE_RECAPTCHA_SECRET'),
    ],
    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '977553392770124',
        'client_secret' => '33284078636dc9face3b8b11a107ba5f',
        'redirect' => 'https://www.veganaffair.in/callback/facebook',
    ],
     'google' => [
        'client_id' => '873603864412-tc8633mn9d4ackkbh8o04dfp6ktqfg6h.apps.googleusercontent.com',
        'client_secret' => 'Mf22tR3XUWV40yuqIulizYg2',
        'redirect' => 'https://www.veganaffair.in/callback/google',
    ],
    

];
