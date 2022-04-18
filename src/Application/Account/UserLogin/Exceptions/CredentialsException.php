<?php

namespace Sds\Application\Account\UserLogin\Exceptions;

use Exception;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

final class CredentialsException extends Exception
{
    public function __construct()
    {
        parent::__construct("Invalid username or password");
    }
}
