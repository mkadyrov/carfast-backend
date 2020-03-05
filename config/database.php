<?php
return ['default' => env('DB_CONNECTION', 'mongodb'),
    'connections' => [

    'mongodb' => [
        'driver' => 'mongodb',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', 27017),
        'database' => env('DB_DATABASE', 'carfast'),
        'username' => env('DB_USERNAME', 'homestead'),
        'password' => env('DB_PASSWORD', 'secret'),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'options' => [
            'database' => env('DB_AUTHENTICATION_DATABASE', 'admin'), // required with Mongo 3+
        ],
    ]]
];
