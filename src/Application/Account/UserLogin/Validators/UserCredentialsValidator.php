<?php

declare(strict_types=1);

namespace Sds\Application\Account\UserLogin\Validators;

use InvalidArgumentException;
use League\Tactician\Middleware;
use Sds\Application\Account\UserLogin\AuthenticatePlayer;

final class UserCredentialsValidator implements Middleware
{
    /**
     * Validate the player's username and password.
     *
     * @param AuthenticatePlayer $command
     * @param callable $next
     * @return mixed|void
     */
    public function execute($command, callable $next)
    {
        if (strlen($command->username) == 0 || strlen($command->password) == 0) {
            throw new InvalidArgumentException("Username or password is empty");
        }

        return $next($command);
    }
}
