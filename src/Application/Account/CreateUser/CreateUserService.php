<?php

namespace Sds\Application\Account\CreateUser;

use Sds\Application\Account\CreateUser\Exceptions\UserExistsException;
use Sds\Application\Account\Hashing\Interfaces\HashServiceInterface;
use Sds\Application\Repositories\UserRepositoryInterface;
use Sds\Application\Specifications\GetUserByEmailSpecification;
use Sds\Application\Specifications\GetUserByUsernameSpecification;
use Sds\Domain\Models\User;
use Sds\Domain\ValueObjects\Gender;
use Sds\Domain\ValueObjects\PlayerName;

final class CreateUserService implements CreateUserServiceInterface
{
    public function __construct(
        private readonly HashServiceInterface $hashService,
        private readonly UserRepositoryInterface $userRepository,
    ) { }

    public function createUser(CreateUserDto $createUserDto): CreateUserResponseDto
    {
        $userExists = $this->userRepository->find(new GetUserByUsernameSpecification($createUserDto->username)) != null;
        if ($userExists) {
            throw new UserExistsException(sprintf("Player name %s is not available", $createUserDto->username));
        }

        $emailExists = $this->userRepository->find(new GetUserByEmailSpecification($createUserDto->email)) != null;
        if ($emailExists) {
            throw new UserExistsException(sprintf("E-mail address %s is already taken", $createUserDto->email));
        }

        $hash = $this->hashService->hash($createUserDto->password);

        $user = new User(
            user: new PlayerName($createUserDto->username),
            password: $hash,
            gender: new Gender($createUserDto->gender),
        );

        // Persist

        // Return DTO
    }
}
