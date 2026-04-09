<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Guard untuk login warga via web (kalau pakai browser)
        'warga' => [
            'driver' => 'session',
            'provider' => 'wargas',
        ],

        // ←←← GUARD INI WAJIB ADA untuk Sanctum API ←←←
        'sanctum' => [
            'driver' => 'sanctum',
            'provider' => 'wargas',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        'wargas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Warga::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];