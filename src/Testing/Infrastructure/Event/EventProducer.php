<?php

declare(strict_types=1);

namespace App\Testing\Infrastructure\Event;

use App\Testing\Domain\Aggregate\DomainEventInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class EventProducer
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
