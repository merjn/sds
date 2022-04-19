<?php

namespace Sds\Application\Account\UserLogin;

class LoginResponseDto
{
    public function __construct(
        public readonly string $token
    ) { }
}
