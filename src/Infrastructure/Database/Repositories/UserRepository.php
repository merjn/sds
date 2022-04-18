<?php

namespace Sds\Infrastructure\Database\Repositories;

use Doctrine\Persistence\ObjectRepository;
use Sds\Application\Repositories\UserRepositoryInterface;
use Sds\Domain\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly ObjectRepository $objectRepository
    ) { }

    public function find($id)
    {
        return $this->objectRepository->find($id);
    }

    public function findByUsername(string $username): ?User
    {
        return $this->objectRepository->findOneBy(['username' => $username]);
    }
}
