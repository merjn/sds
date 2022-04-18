<?php

namespace Sds\Application\Repositories;

use Sds\Domain\Models\User;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function findByUsername(string $username): ?User;
}
