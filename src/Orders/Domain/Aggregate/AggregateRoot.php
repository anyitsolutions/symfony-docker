<?php

declare(strict_types=1);

namespace App\Orders\Domain\Aggregate;

abstract class AggregateRoot
{
    /**
     * @var DomainEventInterface[]
     */
    private array $events = [];

    abstract public function getId(): string;

    /**
     * @return DomainEventInterface[]
     */
    public function getDomainEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    protected function registerDomainEvent(DomainEventInterface $event): void
    {
        $this->events[] = $event;
    }

    public function eventsEmpty(): bool
    {
        return empty($this->events);
    }
}
