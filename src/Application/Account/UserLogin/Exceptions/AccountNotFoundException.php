<?php

namespace Sds\Application\Account\UserLogin\Exceptions;

use Exception;

final class AccountNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Provided account does not exist");
    }
}
