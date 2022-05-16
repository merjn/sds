<?php

namespace Sds\Application\Account\UserLogin;

class AuthenticatePlayerResponse
{
    public function __construct(
        public readonly string $token
    ) { }
}
