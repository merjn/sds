<?php declare(strict_types=1);

namespace Sds\Application\Account\UserLogin;

use Sds\Application\Account\Hashing\Interfaces\HashServiceInterface;
use Sds\Application\Account\UserLogin\Authenticator\AuthenticatorInterface;
use Sds\Application\Account\UserLogin\Events\UserAuthenticated;
use Sds\Application\Account\UserLogin\Exceptions\AuthenticationException;
use Sds\Application\Account\UserLogin\Exceptions\CredentialsException;
use Sds\Application\Interfaces\EventDispatcherInterface;
use Sds\Application\Repositories\UserRepositoryInterface;

final class LoginService implements LoginServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly AuthenticatorInterface $authenticator,
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly HashServiceInterface $hashService
    ) { }

    public function login(LoginDto $loginDto): LoginViewModel
    {
        if (strlen($loginDto->username) < 0 || strlen($loginDto->password) < 0) {
            throw new AuthenticationException("Username or password is empty");
        }

        if (!is_null($user = $this->userRepository->findByUsername($loginDto->username))) {
            if (!$this->hashService->verifyPassword($user, $loginDto->password)) {
                throw new CredentialsException;
            }

            $authenticatorDto = $this->authenticator->authenticate($user->getId());

            $this->eventDispatcher->dispatch(new UserAuthenticated($loginDto->username));

            return new LoginViewModel(
                token: $authenticatorDto->token
            );
        }

        throw new CredentialsException;
    }
}
