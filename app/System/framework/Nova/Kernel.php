<?php

    namespace Lunaris\Framework\Nova;

    use Lunaris\Framework\Nova\Process\Key;
    use Lunaris\Framework\Nova\Process\Module;
    use Lunaris\Framework\Nova\Process\Generate;
    use Lunaris\Framework\Nova\Process\Migration;

    class Kernel
    {
        private $path;
        private $args;

        public function __construct($path) {
            $this->path = $path;
        }

        public function setArgs($args) {
            $this->args = $args;
        }

        public function loadArgs() {
            $args = $this->args;

            if($args[1]) {
                switch($args[1]) {
                    case "migrate" :
                        $migration = new Migration($this->path, $this->args);
                        $migration->execute();
                        break;
                    case "key:generate" :
                        $key = new Key($this->path);
                        $key->generate();
                        break;
                    case "make:module" :
                        $module = new Module($this->path, $this->args);
                        $module->generate();
                        break;
                    case "make:controller" :
                        $generate = new Generate($this->path, $this->args);
                        $generate->controller();
                        break;
                    default :
                        break;
                }
            }
        }
    }