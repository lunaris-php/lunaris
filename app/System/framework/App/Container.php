<?php

    namespace Lunaris\Framework\App;

    use Lunaris\Framework\Http\Router;
    use Lunaris\Framework\Http\Security\CsrfVerifier;

    use Dotenv\Dotenv;

    class Container {
        private $path;

        public function __construct($path) {
            $this->path = $path;
        }

        public function loadEnv() {
            $dotenv = Dotenv::createImmutable($this->path . '/', null, false);
            try {
                $dotenv->load();
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }

        public function loadModules() {
            $modulesFile = $this->path . '/app/Config/modules.php';
            if (file_exists($modulesFile)) {
                $modules = include $modulesFile;

                $this->loadRoutes($modules);
            }
        }

        public function loadRoutes($modules) {
            Router::csrfVerifier(new CsrfVerifier());
            
            $modulesPath = $this->path . '/src/modules/';
            if(count($modules) > 0) {
                foreach($modules as $module) {
                    $routeFile = $modulesPath . $module . '/routes.php';

                    if(file_exists($routeFile)) {
                        require_once $routeFile;
                    }
                }
            }

            Router::start();
        }
    }