<?php

    namespace Lunaris\Framework\Nova;

    use Lunaris\Framework\Nova\Process\Key;
    use Lunaris\Framework\Nova\Process\Module;

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
                    case "key:generate" :
                        $key = new Key($this->path);
                        $key->generate();
                        break;
                    case "make:module" :
                        $module = new Module($this->path, $this->args);
                        $module->generate();
                        break;
                    default :
                        break;
                }
            }
        }
    }