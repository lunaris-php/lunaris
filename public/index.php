<?php

    session_start();

    ini_set("log_errors", 1);
    ini_set("error_log", "../storage/logs/logger.log");

    require_once "../vendor/autoload.php";

    use Lunaris\Framework\App\Container;

    $app = new Container(__DIR__ . '/../');
    $app->loadEnv();
    $app->loadModules();