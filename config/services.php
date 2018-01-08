<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],
    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'paypal' => [
        'client_id' => 'AaivAj4QurhZr5PClsyF46lavA9DmA2B2w81YFH4SuGSqWUuFpVVYynupBUqkBTBLfqTi_uO1nohfU-s',
        'secret' => 'EF2VLAx_9Mj7BeGXrA8D33gOniZRG48YPzhzNxP1VZ7dI3TlHR1SwfJlQfbOOWc5TnZT-FaZRAssuyDK'
    ],
    'facebook' => [
        'client_id' => '153029545173624',
        'client_secret' => '40cdb3dab7ab6530ccc751a0a2cdf9b8',
        'redirect' => 'http://seriousdatings.com/auth/facebook/callback',
    ],

];
