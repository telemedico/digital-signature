<?php

declare(strict_types=1);

namespace App\Shared\DDD;

abstract class AggregateRoot
{
    /**
     * @var array<EventInterface>
     */
    private array $events = [];

    /**
     * @return EventInterface[]
     */
    final public function pullEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    final protected function record(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}
