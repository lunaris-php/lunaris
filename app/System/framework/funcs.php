<?php

    use Lunaris\Framework\Http\Router;

    function env($key, $default = null) {
        if (array_key_exists($key, $_ENV)) {
            $value = $_ENV[$key];
            return $value === false ? $default : $value;
        }
        return $default;
    }

    // ? View utilities

    function view($path, $options = []) {
        $module = $options['module'] ?? 'Main';
        $args = $options['args'] ?? [];
        $path = str_replace(".", "/", $path);
        $viewPath = "../src/modules/" . $module . "/views/" . $path . ".php";
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
        $viewPath = "../src/modules/" . $module . "/views/" . $path . ".php";
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

    // ? Router utilities

    function route(?string $name = null, $parameters = null, ?array $getParams = null): Url
    {
        return Router::getUrl($name, $parameters, $getParams);
    }

    function response(): Response
    {
        return Router::response();
    }

    function request(): Request
    {
        return Router::request();
    }

    function input($index = null, $defaultValue = null, ...$methods)
    {
        if ($index !== null) {
            return request()->getInputHandler()->value($index, $defaultValue, ...$methods);
        }

        return request()->getInputHandler();
    }

    function redirect(string $url, ?int $code = null): void
    {
        if ($code !== null) {
            response()->httpCode($code);
        }

        response()->redirect($url);
    }

    function csrf_token(): ?string
    {
        $baseVerifier = Router::router()->getCsrfVerifier();
        if ($baseVerifier !== null) {
            return $baseVerifier->getTokenProvider()->getToken();
        }

        return null;
    }

    /**
     * ? Storage methods
     */
    function storage_path($path)
    {
        $file = dirname(__FILE__)."/../storage/public/".$path;
        return $file;
    }

    function storage_asset($string)
    {
        $string = server() . "/storage/public/" . $string;
        return $string;
    }

    function storage_exists($path)
    {
        if(file_exists("./storage/public/" . $path))
        {
            return true;
        }
        return false;
    }

    function storage_unlink($path)
    {
        if(storage_exists($path))
        {
            unlink("../storage/public/".$path);
            return true;
        }
        return false;
    }
    /**
     * * End of storage methods
     */

    function server()
    {
        $host = $_SERVER['HTTP_HOST'];
        $proto = "http";
        if(isset($_SERVER['HTTP_X_ORIGINAL_HOST']) && !empty($_SERVER['HTTP_X_ORIGINAL_HOST'])) {
            $host = $_SERVER['HTTP_X_ORIGINAL_HOST'];
        }
        if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && !empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
            $proto = $_SERVER['HTTP_X_FORWARDED_PROTO'];
        }
        $host = $proto . "://" . $host;
        return $host;
    }

    // ? To get asset URLs
    function asset($string)
    {
        $enurl = server();
        $string = $enurl . "/public/" . $string;
        return $string;
    }

    // ? To get old form input values
    function old($name)
    {
        if(session_exists($name))
        {
            $value = get_session($name);
            unset_session($name);
            return $value;
        }
        return false;
    }