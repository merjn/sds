<?php

namespace Sds\Application\Account\Hashing\Interfaces;

use Sds\Domain\Models\User;

interface HashServiceInterface
{
    public function verifyPassword(User $user, string $password): bool;

    public function hash(string $plaintext): string;
}
