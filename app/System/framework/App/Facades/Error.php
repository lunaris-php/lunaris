<?php

    namespace Lunaris\Framework\App\Facades;

    class Error
    {
        public static function put($name, $value) {
            $key = "error-" . $name;
            $_SESSION[$key] = $value;
            return true;
        }

        public static function get($name) {
            $key = "error-" . $name;
            if(isset($_SESSION[$key]) && !empty($_SESSION[$key]))
            {
                return $_SESSION[$key];
            }
            return false;
        }

        public static function has($name) {
            $key = "error-" . $name;
            if(isset($_SESSION[$key]) && !empty($_SESSION[$key]))
            {
                return true;
            }
            return false;
        }
    }