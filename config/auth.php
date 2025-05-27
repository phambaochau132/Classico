<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'system_users',
    ],

    'guards' => [
        'customer' => [
            'driver' => 'session',
            'provider' => 'customers',
        ],
        'web' => [
            'driver' => 'session',
            'provider' => 'system_users',
        ],
    ],

    'providers' => [
        'customers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Customer::class,
        ],
        'system_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\SystemUser::class,
        ],

    ],


    'passwords' => [
        'system_users' => [
            'provider' => 'system_users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
