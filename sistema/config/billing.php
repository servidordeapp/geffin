<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the drivers for third party payment providers such
    | as Stripe, PayPal, Asaas, and more.
    */

    'providers' => [

        'asaas' => [
            'sandbox' => [
                'url' => env('ASAAS_SANDBOX_URL').'/'.env('ASAAS_API_VERSION', 'v3'),
                'api_key' => env('ASAAS_SANDBOX_API_KEY'),
            ],
            'production' => [
                'url' => env('ASAAS_PROD_URL').'/'.env('ASAAS_API_VERSION', 'v3'),
                'api_key' => env('ASAAS_PROD_API_KEY'),
            ],
        ],
    ],
];
