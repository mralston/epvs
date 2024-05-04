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

    'endpoint' => env('EPVS_ENDPOINT', 'https://validationhub.co.uk/api/v1'),

    /*
    |--------------------------------------------------------------------------
    | Status Poller
    |--------------------------------------------------------------------------
    |
    | When enabled, the status of active finance applications will be polled regularly.
    |
    */

    'status_poller_enabled' => env('EPVS_POLL_STATUSES', true),
];
