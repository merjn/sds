<?php

declare(strict_types=1);

namespace Sds\Application\Account\UserLogin\Middleware;

use League\Tactician\Middleware;
use Sds\Application\Account\UserLogin\Events\LoginFailed;
use Sds\Application\Account\UserLogin\Events\UserAuthenticated;
use Sds\Application\Account\UserLogin\Exceptions\CredentialsException;
use Sds\Application\Account\UserLogin\AuthenticatePlayer;
use Sds\Application\Interfaces\EventDispatcherInterface;

final class PublishEventOnPlayerAuthenticationMiddleware implements Middleware
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher
    ) { }

    /**
     * Execute events after the player has - or hasn't been - authenticated.
     *
     * @param AuthenticatePlayer $command
     * @param callable $next
     * @return \Illuminate\Support\HigherOrderTapProxy|mixed|void
     */
    public function execute($command, callable $next)
    {
        try {
            return tap($next($command), function () use ($command) {
                $this->eventDispatcher->dispatch(new UserAuthenticated(
                    username: $command->username,
                    ipAddress: $command->ipAddress
                ));
            });
        } catch (CredentialsException $credentialsException) {
            $this->eventDispatcher->dispatch(new LoginFailed(
                username: $credentialsException->username,
                ipAddress: $credentialsException->ipAddress
            ));
        }
    }
}
