<?php

declare(strict_types=1);

namespace App\Payments\Infrastructure\Event;

use App\Payments\Domain\Aggregate\DomainEventInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DomainEventProducer
{
    public function __construct(private MessageBusInterface $eventBus, private NormalizerInterface $normalizer)
    {
    }

    public function produce(object ...$events): void
    {
        foreach ($events as $event) {
            $stamps = [];
            if ($event instanceof DomainEventInterface) {
                $event = $this->wrap($event);
                //                $stamps[] = new AmqpStamp($event->getEventType());
            }

            $this->eventBus->dispatch($event, $stamps);
        }
    }

    private function wrap(DomainEventInterface $event): EventEnvelope
    {
        return new EventEnvelope(
            $event->getType(),
            $this->normalizer->normalize($event)
        );
    }
}
