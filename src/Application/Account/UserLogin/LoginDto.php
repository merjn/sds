<?php

namespace Sds\Application\Account\UserLogin;

final class LoginDto
{
    public function __construct(
        public readonly string $username,
        public readonly string $password,
        public readonly string $ipAddress
    ) { }
}
