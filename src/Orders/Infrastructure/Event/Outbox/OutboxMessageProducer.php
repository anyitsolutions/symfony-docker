<?php

declare(strict_types=1);

namespace App\Orders\Infrastructure\Event\Outbox;

use App\Orders\Domain\Aggregate\DomainEventInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class OutboxMessageProducer
{
    public function __construct(private MessageBusInterface $bus)
    {
    }

    public function produce(DomainEventInterface ...$events): void
    {
        foreach ($events as $event) {
            $message = new OutboxMessage($event);
            $this->bus->dispatch($message);
        }
    }
}
