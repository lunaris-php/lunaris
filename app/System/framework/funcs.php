<?php

    use Exception;

    function env($key, $default = null) {
        if (array_key_exists($key, $_ENV)) {
            $value = $_ENV[$key];
            return $value === false ? $default : $value;
        }
        return $default;
    }

    function view($path, $options = []) {
        $module = $options['module'] ?? 'Main';
        $args = $options['args'] ?? [];
        $path = str_replace(".", "/", $path);
        $viewPath = "src/modules/" . $module . "/views/" . $path . ".php";
        if (!file_exists($viewPath)) {
            throw new Exception("View file not found: {$viewPath}");
        }
        extract($args);
        ob_start();
        include($viewPath);
        $var=ob_get_contents(); 
        ob_end_clean();
        return $var;
    }

    function inject($path, $options = []) {
        $module = $options['module'] ?? 'Main';
        $args = $options['args'] ?? [];
        $path = str_replace(".", "/", $path);
        $viewPath = "src/modules/" . $module . "/views/" . $path . ".php";
        if (!file_exists($viewPath)) {
            throw new Exception("View file not found: {$viewPath}");
        }
        extract($args);
        ob_start();
        include($viewPath);
        $var=ob_get_contents(); 
        ob_end_clean();
        echo $var;
    }