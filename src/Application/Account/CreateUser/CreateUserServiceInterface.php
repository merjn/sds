<?php

namespace Sds\Application\Account\CreateUser;

interface CreateUserServiceInterface
{
    public function createUser(CreateUserDto $createUserDto): CreateUserResponseDto;
}
