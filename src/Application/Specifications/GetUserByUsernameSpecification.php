<?php

namespace Sds\Application\Specifications;

use Happyr\DoctrineSpecification\Filter\Equals;
use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Query\QueryModifier;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;

class GetUserByUsernameSpecification extends BaseSpecification
{
    private readonly string $username;

    public function __construct(string $username, ?string $context = null)
    {
        parent::__construct($context);

        $this->username = $username;
    }

    protected function getSpec(): QueryModifier|Equals|Filter
    {
        return Spec::eq('user.username', $this->username);
    }
}
