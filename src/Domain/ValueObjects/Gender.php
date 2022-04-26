<?php

namespace Sds\Domain\ValueObjects;

use Sds\Domain\Exceptions\GenderException;

class Gender
{
    private readonly string $gender;

    public function __construct(string $gender)
    {
        $gender = strtolower($gender);
        if ($gender != 'm' || $gender != 'f') {
            throw new GenderException("Given gender is invalid");
        }

        $this->gender = $gender;
    }

    public function equal(Gender $valueObject): bool
    {
        return $valueObject->gender == $this->gender;
    }

    public function __toString(): string
    {
        return $this->gender;
    }
}
