<?php

namespace Sds\Infrastructure\Event;

use Illuminate\Contracts\Events\Dispatcher;
use Sds\Application\Interfaces\EventDispatcherInterface;

class LaravelEventDispatcher implements EventDispatcherInterface
{
    public function __construct(
        private readonly Dispatcher $dispatcher
    ) { }

    public function dispatch(mixed $dispatchable): void
    {
        $this->dispatcher->dispatch($dispatchable);
    }
}
