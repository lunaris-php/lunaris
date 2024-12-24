<?php

    use Lunaris\Framework\Http\Router;

    Router::get('/about', [Module\About\AboutController::class, 'about'])->name('about');