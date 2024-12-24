<?php

    use Lunaris\Framework\Http\Router;

    Router::get("/", [Module\Main\MainController::class, 'index'])->name('index');