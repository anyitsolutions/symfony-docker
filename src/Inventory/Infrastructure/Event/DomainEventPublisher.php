<?php

declare(strict_types=1);

namespace App\Inventory\Infrastructure\Event;

use App\Inventory\Domain\Aggregate\DomainEventInterface;
use App\Inventory\Domain\Service\DomainEventPublisherInterface;
use App\Inventory\Infrastructure\Event\Outbox\OutboxMessageProducer;

final class DomainEventPublisher implements DomainEventPublisherInterface
{
    public function __construct(private OutboxMessageProducer $outboxProducer)
    {
    }

    public function publish(DomainEventInterface ...$events): void
    {
        $this->outboxProducer->produce(...$events);
    }
}
