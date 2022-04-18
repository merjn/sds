<?php

namespace Sds\Infrastructure\Hashing;

use Illuminate\Support\Facades\Hash;
use Sds\Application\Account\Hashing\Interfaces\HasherInterface;

class Hasher implements HasherInterface
{

    public function hash(string $plaintext): string
    {
        return Hash::make($plaintext);
    }

    public function check(string $plaintext, string $hash): bool
    {
        return Hash::check($plaintext, $hash);
    }
}
