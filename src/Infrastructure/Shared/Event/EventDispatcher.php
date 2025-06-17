<?php

namespace App\Infrastructure\Shared\Event;

class EventDispatcher
{
    private array $listeners = [];

    public function listen(string $eventClass, callable $listener): void
    {
        $this->listeners[$eventClass][] = $listener;
    }

    public function dispatch(object $event): void
    {
        $eventClass = get_class($event);
        foreach ($this->listeners[$eventClass] ?? [] as $listener) {
            $listener($event);
        }
    }
}
