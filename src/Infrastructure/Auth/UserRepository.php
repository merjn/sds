<?php

namespace Sds\Infrastructure\Auth;

class UserRepository
{
    public function find(int $id): ?User
    {
        return User::where('id', '=', $id)->first();
    }
}
