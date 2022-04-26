<?php

namespace Sds\Application\Account\CreateUser\Exceptions;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class UserExistsException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
