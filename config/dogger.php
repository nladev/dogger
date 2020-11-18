<?php

return [
    /*
    |--------------------------------------------------------------------------
    |  Request Exclusions
    |--------------------------------------------------------------------------
    |
    | This sets which request data is excluded from the logging
    |
    */
    'dont_log' => [
        'password', 'password_confirmation', 'new_password', 'old_password',
    ],

    /*
    |--------------------------------------------------------------------------
    |  Request headers to log
    |--------------------------------------------------------------------------
    |
    | This sets which request headers for logging
    |
    */
    'headers' => [
        'user-agent'
    ]
];