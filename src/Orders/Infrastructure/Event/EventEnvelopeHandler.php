<?php

declare(strict_types=1);

namespace App\Orders\Infrastructure\Event;

use App\Orders\Domain\Aggregate\Order\OrderCreatedEvent;
use App\Shared\Domain\Event\EventType;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

#[AsMessageHandler]
final class EventEnvelopeHandler
{
    private const EVENT_MAP = [
        EventType::ORDERS_ORDER_CREATED => OrderCreatedEvent::class,
    ];

    public function __construct(private DenormalizerInterface $denormalizer, private MessageBusInterface $eventBus)
    {
    }

    public function __invoke(EventEnvelope $eventEnvelope): void
    {
        $class = self::EVENT_MAP[$eventEnvelope->getEventType()] ?? null;
        if (null === $class) {
            return;
        }

        $domainEvent = $this->denormalizer->denormalize($eventEnvelope->getEventData(), $class);
        $this->eventBus->dispatch($domainEvent);
    }
}
