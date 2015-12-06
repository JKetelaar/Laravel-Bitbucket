<?php
/**
 * @author JKetelaar
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */
    'default'     => 'main',
    /*
    |--------------------------------------------------------------------------
    | Bitbucket Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like. Note that the 3 supported authentication methods are:
    | "application", "password", and "token".
    |
    */
    'connections' => [
        'main'        => [
            'token'  => env('BB_AUTH_TOKEN', 'your-token'),
            'method' => env('BB_AUTH_METHOD', 'token')
        ],
        'alternative' => [
            'clientId'     => 'your-client-id',
            'clientSecret' => 'your-client-secret',
            'method'       => 'application'
        ],
        'other'       => [
            'username' => 'your-username',
            'password' => 'your-password',
            'method'   => 'password'
        ],
    ],
];
