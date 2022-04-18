<?php

namespace Sds\Domain\Models;

final class User
{
    public function __construct(
        protected readonly int $id,
        protected string $username,
        protected string $password
    ) { }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
