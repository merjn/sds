<?php

namespace Sds\Application\Account\Hashing;

class PasswordOptions
{
    public function __construct(
        public readonly string $secretKey
    ) { }
}
