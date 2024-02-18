<?php

declare(strict_types=1);

namespace App\Orders\Infrastructure\Event;

use App\Orders\Domain\Aggregate\DomainEventInterface;
use App\Orders\Domain\Service\DomainEventPublisherInterface;
use App\Orders\Infrastructure\Event\Outbox\OutboxMessageProducer;

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
