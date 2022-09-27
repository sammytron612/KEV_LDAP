<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'overwatch','hydra'.'cybertron',

    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'hydra' => [
            'driver' => 'session',
            'provider' => 'hydra',
        ],

        'overwatch' => [
            'driver' => 'session',
            'provider' => 'overwatch',
        ],

        'cybertron' => [
            'driver' => 'session',
            'provider' => 'cybertron',
        ],
        'azmodeus' => [
            'driver' => 'session',
            'provider' => 'azmodeus',
        ],
    ],


    'providers' => [
        'hydra' => [
            'driver' => 'Ldap',
            'model' => App\Ldap\Hydra\User::class,
            'sync_passwords' => false,
            'database' => [
                'model' => App\Models\User::class,
                'sync_passwords' => false,
                'sync_attributes' => [
                    'name' => 'cn',
                    'username' => 'samaccountname',
                    'email' => 'mail',
                    'upn' => 'UserPrincipalName'
                ],
            ],
        ],

        'cybertron' => [
            'driver' => 'Ldap',
            'model' => App\Ldap\Cybertron\User::class,
            'sync_passwords' => false,
            'database' => [
                'model' => App\Models\User::class,
                'sync_passwords' => false,
                'sync_attributes' => [
                    'name' => 'cn',
                    'username' => 'samaccountname',
                    'email' => 'mail',
                    'upn' => 'UserPrincipalName'
                ],
            ],
        ],

        'azmodeus' => [
            'driver' => 'Ldap',
            'model' => App\Ldap\Azmodeus\User::class,
            'sync_passwords' => false,
            'database' => [
                'model' => App\Models\User::class,
                'sync_passwords' => false,
                'sync_attributes' => [
                    'name' => 'cn',
                    'username' => 'samaccountname',
                    'email' => 'mail',
                    'upn' => 'UserPrincipalName'
                ],
            ],
        ],


        'overwatch' => [
            'driver' => 'Ldap',
            'model' => App\Ldap\Overwatch\User::class,
            'sync_passwords' => false,
            'database' => [
                'model' => App\Models\User::class,
                'sync_passwords' => false,
                'sync_attributes' => [
                    'name' => 'cn',
                    'username' => 'samaccountname',
                    'email' => 'mail',
                    'upn' => 'UserPrincipalName'
                ],
            ],
        ],
    ],



    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
