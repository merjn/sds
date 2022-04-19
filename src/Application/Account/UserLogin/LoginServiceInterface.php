<?php

namespace Sds\Application\Account\UserLogin;

interface LoginServiceInterface
{
    public function login(LoginDto $loginDto): LoginResponseDto;
}
