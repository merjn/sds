<?php

namespace Sds\Application\Repositories;

use Happyr\DoctrineSpecification\Specification\BaseSpecification;

interface BaseRepositoryInterface
{
    public function find(BaseSpecification $baseSpecification);
}
