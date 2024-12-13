<?php

    use Lunaris\Framework\Router;

    Router::get('/', function() {
        return "Hello world from route";
    });

    Router::get('/about', [App\Controllers\StartController::class, 'home']);

    Router::start();