<?php

namespace Sds\Application\Account\UserLogin;

use Sds\Application\Account\UserLogin\LoginDto;
use Sds\Application\Account\UserLogin\LoginViewModel;

interface LoginServiceInterface
{
    public function login(LoginDto $loginDto): LoginViewModel;
}
