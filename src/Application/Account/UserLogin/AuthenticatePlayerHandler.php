<?php

declare(strict_types=1);

namespace Sds\Application\Account\UserLogin;

use Sds\Application\Account\Hashing\Interfaces\HashServiceInterface;
use Sds\Application\Account\UserLogin\Authenticator\AuthenticatorInterface;
use Sds\Application\Account\UserLogin\Exceptions\AccountNotFoundException;
use Sds\Application\Account\UserLogin\Exceptions\CredentialsException;
use Sds\Application\Repositories\UserRepositoryInterface;
use Sds\Application\Specifications\GetUserByUsernameSpecification;

final class AuthenticatePlayerHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly AuthenticatorInterface $authenticator,
        private readonly HashServiceInterface $hashService
    ) { }

    public function handle(AuthenticatePlayer $authenticatePlayer): AuthenticatePlayerResponse
    {
        $userExistsSpecification = new GetUserByUsernameSpecification($authenticatePlayer->username);

        if (!is_null($user = $this->userRepository->find($userExistsSpecification))) {
            if (!$this->hashService->verifyPassword($user, $authenticatePlayer->password)) {
                throw new CredentialsException;
            }

            $authenticatorDto = $this->authenticator->authenticate($user->getId());

            return new AuthenticatePlayerResponse(
                token: $authenticatorDto->token
            );
        }

        throw new AccountNotFoundException;
    }
}
