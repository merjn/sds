<?php

namespace Sds\Application\Account\UserLogin\Authenticator;

interface AuthenticatorInterface
{
    public function authenticate(int $id): AuthenticatorDto;
}
