<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Credentials
    |--------------------------------------------------------------------------
    |
    | Used to authenticate with the EPVS API
    |
    */

    'token' => env('EPVS_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Endpoint
    |--------------------------------------------------------------------------
    |
    | Base URL for the EPVS API.
    |
    */

    'endpoint' => env('EPVS_ENDPOINT', 'https://www.validationhub.co.uk/api/v1'),

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    |
    | Base URL for the EPVS Dashboard.
    |
    */

    'dashboard' => env('EPVS_DASHBOARD', 'https://www.validationhub.co.uk'),

    /*
    |--------------------------------------------------------------------------
    | Webhook Protection
    |--------------------------------------------------------------------------
    |
    | Choose which middleware is applied to the webhook endpoint
    |
    */

    'webhook_middleware' => env('EPVS_WEBHOOK_MIDDLEWARE', 'auth:sanctum'),
];
