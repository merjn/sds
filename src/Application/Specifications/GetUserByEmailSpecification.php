<?php

namespace Sds\Application\Specifications;

use Happyr\DoctrineSpecification\Filter\Equals;
use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Query\QueryModifier;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;

class GetUserByEmailSpecification extends BaseSpecification
{
    private readonly string $email;

    public function __construct(string $email, ?string $context = null)
    {
        parent::__construct($context);

        $this->email = $email;
    }

    protected function getSpec(): QueryModifier|Equals|Filter
    {
        return Spec::eq('mail', $this->email);
    }
}
