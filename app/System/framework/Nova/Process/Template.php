<?php

    namespace Lunaris\Framework\Nova\Process;

    class Template {
        public static function controller($moduleName, $controllerName=null) {
            if(!$controllerName) {
                $controllerName = $moduleName . 'Controller';
            }

            $controllerFileContent = <<<PHP
            <?php
                namespace Module\\{$moduleName};

                class {$controllerName}
                {
                    public function index() {
                        echo "This is the {$moduleName} module.";
                    }
                }
            PHP;

            return $controllerFileContent;
        }

        public static function router($moduleName) {
            $routerFileContent = <<<PHP
            <?php

                use Lunaris\Framework\Http\Router;

                Router::get("/{$moduleName}", [Module\\{$moduleName}\\{$moduleName}Controller::class, 'index']);
            PHP;

            return $routerFileContent;
        }
    }