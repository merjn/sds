<?php

namespace Sds\Application\Account\UserLogin\Events;

class LoginFailed
{
    public function __construct(
        public readonly string $username,
        public readonly string $ipAddress
    ) { }
}
