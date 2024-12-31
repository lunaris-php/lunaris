<?php

    namespace Lunaris\Framework\Http\Security;

    use Pecee\Http\Middleware\BaseCsrfVerifier;
    use Lunaris\Framework\Http\Security\SessionTokenProvider;

    class CsrfVerifier extends BaseCsrfVerifier
    {
        public function __construct()
        {
            $this->setTokenProvider(new SessionTokenProvider());
        }

        public function validateToken(string $token): bool
        {
            return parent::validateToken($token);
        }
    }