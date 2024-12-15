<?php

    namespace Lunaris\Framework\App;

    use Dotenv\Dotenv;

    use Lunaris\Framework\Router;

    class Container {
        private $path;

        public function __construct($path) {
            $this->path = $path;
        }

        public function loadRoutes() {
            require_once $this->path . '/routes/web.php';
            Router::start();
        }

        public function loadEnv() {
            $dotenv = Dotenv::createImmutable($this->path . '/', null, false);
            try {
                $dotenv->load();
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }