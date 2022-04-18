<?php

namespace Sds\Application\Interfaces;

interface EventDispatcherInterface
{
    public function dispatch(mixed $dispatchable): void;
}
