<?php

    namespace Lunaris\Framework\Nova;

    use Lunaris\Framework\Nova\Process\Key;

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
                    case "generate-key" :
                        $key = new Key($this->path);
                        $key->generate();
                        break;
                    default :
                        break;
                }
            }
        }
    }