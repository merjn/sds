<?php

namespace Sds\Application\Account\UserLogin\Events;

class UserAuthenticated
{
    public function __construct(
        public readonly string $username
    ) { }
}
