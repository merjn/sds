<?php

namespace Sds\Application\Account\UserLogin;

class LoginViewModel
{
    public function __construct(
        public readonly string $token
    ) { }
}
