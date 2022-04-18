<?php declare(strict_types=1);

namespace Sds\Application\Account\UserLogin\Authenticator;

final class AuthenticatorDto
{
    public function __construct(
        public readonly string $token
    ) { }
}
