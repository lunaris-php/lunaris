<?php

    namespace Lunaris\Framework\Nova\Process;

    use Exception;

    class Module
    {
        private $path;
        private $args;

        public function __construct($path, $args) {
            $this->path = $path;
            $this->args = $args;
        }

        public function generate() {
            $moduleName = $this->args[2] ?? null;
            $moduleName = ucfirst($moduleName); 

            if(!$moduleName) {
                throw new Exception("Error: Please provide a module name. Example: php cli make:module [module_name]");
            }

            $modulePath = $this->path . '/src/modules/' . $moduleName;

            if(file_exists($modulePath)) {
                throw new Exception("Error: Module '{$moduleName}' already exists in src/modules.");
            }

            $this->createModule($modulePath, $moduleName);
        }

        public function createModule($modulePath, $moduleName) {
            mkdir($modulePath, 0755, true);
            mkdir("{$modulePath}/views", 0755, true);

            $controllerCode = $this->getControllerCode($moduleName);
            file_put_contents("{$modulePath}/{$moduleName}Controller.php", $controllerCode);

            $routerCode = $this->getRouterCode($moduleName);
            file_put_contents("{$modulePath}/routes.php", $routerCode);
            
            echo "Module '{$moduleName}' created successfully in src/modules." . PHP_EOL;
            echo "Add module name {$moduleName} to App/Config/modules.php to activate the module." . PHP_EOL;
        }

        public function getControllerCode($moduleName) {
            $controllerFileContent = <<<PHP
            <?php
                namespace Module\\{$moduleName};

                class {$moduleName}Controller {
                    public function index() {
                        echo "This is the {$moduleName} module.";
                    }
                }
            PHP;

            return $controllerFileContent;
        }

        public function getRouterCode($moduleName) {
            $routerFileContent = <<<PHP
            <?php

                use Lunaris\Framework\Http\Router;

                Router::get("/{$moduleName}", function() {
                    return "This is the {$moduleName} route.";
                });
            PHP;

            return $routerFileContent;
        }
    }