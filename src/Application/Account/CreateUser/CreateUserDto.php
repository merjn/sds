<?php

namespace Sds\Application\Account\CreateUser;

class CreateUserDto
{
    public function __construct(
        public readonly string $username,
        public readonly string $password,
        public readonly string $email,
        public readonly string $ipAddress,
        public readonly string $gender
    ) { }
}
