<?php

    use Lunaris\Framework\Router;

    Router::get('/', function() {
        echo getenv('TEST_VARIABLE');
        return "Hello world from route";
    });

    Router::get('/about', [App\Controllers\StartController::class, 'home']);

    // Router::start();