<?php

namespace Sds\Domain\Exceptions;

use Exception;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

final class PlayerNameTooSmallException extends Exception
{
    public function __construct(string $name)
    {
        parent::__construct("Player name ${name} is too small");
    }
}
