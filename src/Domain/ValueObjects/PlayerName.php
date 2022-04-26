<?php

namespace Sds\Domain\ValueObjects;

use Sds\Domain\Exceptions\PlayerNameNotAllowedException;
use Sds\Domain\Exceptions\PlayerNameTooLongException;
use Sds\Domain\Exceptions\PlayerNameTooSmallException;

class PlayerName
{
    public readonly string $username;

    private string $allowedCharacters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-@!";

    public function __construct(string $username)
    {
        if (strlen($username) < 3) {
            throw new PlayerNameTooSmallException($username);
        }

        if (strlen($username) > 15) {
            throw new PlayerNameTooLongException($username);
        }

        foreach (str_split($username) as $characterInName) {
            if (!str_contains($this->allowedCharacters, $characterInName)){
                throw new PlayerNameNotAllowedException("Character ${characterInName} is not allowed");
            }
        }

        $this->username = $username;
    }

    public function equal(PlayerName $valueObject): bool
    {
        return $valueObject->username == $this->username;
    }

    public function __toString(): string
    {
        return $this->username;
    }
}
