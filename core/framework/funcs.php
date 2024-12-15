<?php

    function env($key, $default = null) {
        if (array_key_exists($key, $_ENV)) {
            $value = $_ENV[$key];
            return $value === false ? $default : $value;
        }
        return $default;
    }