<?php declare(strict_types=1);

namespace Sds\Infrastructure\Auth;

use Sds\Application\Account\UserLogin\Authenticator\AuthenticatorDto;
use Sds\Application\Account\UserLogin\Authenticator\AuthenticatorInterface;
use Sds\Application\Account\UserLogin\Exceptions\CredentialsException;
use Sds\Application\Account\UserLogin\TokenConstants;

final class PassportAuthenticator implements AuthenticatorInterface
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) { }

    public function authenticate(int $id): AuthenticatorDto
    {
        if (!is_null($user = $this->userRepository->find($id))) {
            return new AuthenticatorDto(
                token: $user->createToken(TokenConstants::NAME)->plainTextToken
            );
        }

        throw new CredentialsException;
    }
}
