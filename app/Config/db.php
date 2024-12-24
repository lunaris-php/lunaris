<?php

    return [
        'driver'    => env('DB_DRIVER', 'mysql'), // Supported: mysql, pgsql, sqlite, sqlsrv
        'host'      => env('DB_HOST', '127.0.0.1'),
        'database'  => env('DB_NAME', ''),
        'username'  => env('DB_USER', 'root'),
        'password'  => env('DB_PASSWORD', ''),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ];