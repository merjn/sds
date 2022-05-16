<?php

namespace Sds\Application\Account\UserLogin;

interface LoginServiceInterface
{
    public function login(AuthenticatePlayer $loginDto): AuthenticatePlayerResponse;
}
