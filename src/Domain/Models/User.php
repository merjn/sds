<?php

namespace Sds\Domain\Models;

use Sds\Domain\Exceptions\GenderException;
use Sds\Domain\ValueObjects\Gender;
use Sds\Domain\ValueObjects\PlayerName;

final class User
{
    private int $id;

    public function __construct(
        private readonly PlayerName $user,
        private readonly string $password,
        private readonly string $gender
    ) { }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getGender(): string
    {
        return $this->gender;
    }
}
