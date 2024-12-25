<?php

    namespace Lunaris\Framework\App\Facades;

    use Defuse\Crypto\Key;
    use Defuse\Crypto\Crypto;
    use InvalidArgumentException;

    class Crypt
    {
        private static function key()
        {
            $keyAscii = env('APP_KEY', '');
            if (empty($keyAscii)) {
                throw new InvalidArgumentException('APP_KEY is not set in the environment file.');
            }
            return Key::loadFromAsciiSafeString($keyAscii);
        }

        public static function encrypt($string)
        {
            $key = self::key();
            $ciphertext = Crypto::encrypt($string, $key);
            return $ciphertext;
        }

        public static function decrypt($ciphertext)
        {
            $key = self::key();
            $secret_data = Crypto::decrypt($ciphertext, $key);
            return $secret_data;
        }
    }