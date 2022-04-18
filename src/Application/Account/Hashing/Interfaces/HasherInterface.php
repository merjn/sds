<?php

namespace Sds\Application\Account\Hashing\Interfaces;

interface HasherInterface
{
    public function hash(string $plaintext): string;

    public function check(string $plaintext, string $hash): bool;
}
