<?php

declare(strict_types=1);

namespace App\Payments\Infrastructure\Event;

use App\Payments\Domain\Aggregate\DomainEventInterface;
use App\Payments\Domain\Service\DomainEventPublisherInterface;
use App\Payments\Infrastructure\Event\Outbox\OutboxMessageProducer;

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
