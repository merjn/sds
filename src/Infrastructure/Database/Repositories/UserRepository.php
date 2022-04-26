<?php

namespace Sds\Infrastructure\Database\Repositories;

use Doctrine\Persistence\ObjectRepository;
use Happyr\DoctrineSpecification\Repository\EntitySpecificationRepositoryInterface;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;
use Sds\Application\Repositories\UserRepositoryInterface;
use Sds\Domain\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly EntitySpecificationRepositoryInterface $objectRepository
    ) { }

    public function find(BaseSpecification $baseSpecification): ?User
    {
        return $this->objectRepository->matchOneOrNullResult($baseSpecification);
    }
}
