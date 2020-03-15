<?php
return ['default' => env('DB_CONNECTION', 'mongodb'),
    'connections' => [

    'mongodb' => [
        'driver' => 'mongodb',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', 27017),
        'database' => 'kolesa',
        'username' => env('DB_USERNAME', ''),
        'password' => env('DB_PASSWORD', ''),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'options' => [
            'database' => env('DB_AUTHENTICATION_DATABASE', 'admin'), // required with Mongo 3+
        ],
    ]
    ]
];
