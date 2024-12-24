<?php

    namespace Lunaris\Framework\Nova\Process;

    use Defuse\Crypto\Key as Code;

    use Exception;

    class Key
    {
        private $path;

        public function __construct($path) {
            $this->path = $path;
        }

        public function generate() {
            $envFilePath = $this->path . '/.env';
            $key = Code::createNewRandomKey()->saveToAsciiSafeString();
            $envKeyVariable = 'APP_KEY';

            if (!file_exists($envFilePath)) {
                throw new Exception(".env file not found at: {$envFilePath}");
            }

            $envContent = file_get_contents($envFilePath);

            if (preg_match("/^{$envKeyVariable}=/m", $envContent)) {
                // Update the existing key
                $envContent = preg_replace(
                    "/^{$envKeyVariable}=.*/m",
                    "{$envKeyVariable}={$key}",
                    $envContent
                );
            } else {
                // Append the new key
                $envContent .= PHP_EOL . "{$envKeyVariable}={$key}" . PHP_EOL;
            }

            file_put_contents($envFilePath, $envContent);

            echo "Key generated successfully" . PHP_EOL;
        }
    }