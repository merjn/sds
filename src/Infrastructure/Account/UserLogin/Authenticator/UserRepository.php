<?php

namespace Sds\Infrastructure\Account\UserLogin\Authenticator;

class UserRepository
{
    public function find(int $id): ?User
    {
        return User::where('id', '=', $id)->first();
    }
}
