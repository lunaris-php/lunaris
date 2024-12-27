<?php

    namespace Lunaris\Framework\Nova\Process;

    use Exception;

    use Lunaris\Framework\Nova\Process\Template;

    class Generate
    {
        private $path;
        private $args;

        public function __construct($path, $args) {
            $this->path = $path;
            $this->args = $args;
        }

        public function controller()
        {
            $controllerName = $this->args[2] ?? null;
            $moduleName = $this->args[3] ?? null;

            if(!$controllerName) {
                throw new Exception("Error: Please provide a controller name. Example: php nova make:controller [controller_name] [module_name]");
            }

            if(!$moduleName) {
                throw new Exception("Error: Please provide module name. Example: php nova make:controller [controller_name] [module_name]");
            }

            $modulePath = $this->path . '/src/modules/' . $moduleName;
            if(!file_exists($modulePath)) {
                throw new Exception("Error: Module '{$moduleName}' not exists in src/modules.");
            }

            $controllerPath = $modulePath . '/' . $controllerName . '.php';
            if(file_exists($controllerPath)) {
                throw new Exception("Error: controller '{$controllerName}' already exists in {$moduleName} module.");
            }

            $controllerCode = Template::controller($moduleName, $controllerName);
            file_put_contents($controllerPath, $controllerCode);

            echo $controllerName . " has been created inside " . $moduleName . " module." . PHP_EOL;
        }
    }