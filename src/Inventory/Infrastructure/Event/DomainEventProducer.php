<?php

declare(strict_types=1);

namespace App\Inventory\Infrastructure\Event;

use App\Inventory\Domain\Aggregate\DomainEventInterface;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DomainEventProducer
{
    public function __construct(private MessageBusInterface $eventBus, private NormalizerInterface $normalizer)
    {
    }

    public function produce(DomainEventInterface ...$events): void
    {
        foreach ($events as $event) {
            $event = $this->wrapDomainEvent($event);
            $stamps = [
                new AmqpStamp($event->getEventType()),
                new DispatchAfterCurrentBusStamp(),
            ];

            $this->eventBus->dispatch($event, $stamps);
        }
    }

    private function wrapDomainEvent(DomainEventInterface $event): EventEnvelope
    {
        return new EventEnvelope(
            $event->getType(),
            $this->normalizer->normalize($event)
        );
    }
}
