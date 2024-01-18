<?php

declare(strict_types=1);

namespace App\Payments\Infrastructure\Event;

use App\Payments\Application\ExternalEvents\OrderCreatedExternalEvent;
use App\Shared\Domain\Event\EventType;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

#[AsMessageHandler]
final class EventEnvelopeHandler
{
    private const MAP = [
        EventType::ORDERS_ORDER_CREATED => OrderCreatedExternalEvent::class,
    ];

    public function __construct(private DenormalizerInterface $denormalizer, private MessageBusInterface $eventBus)
    {
    }

    public function __invoke(EventEnvelope $eventEnvelope): void
    {
        $domainEvent = $this->denormalizer->denormalize(
            $eventEnvelope->getEventData(),
            $this->getClassByType($eventEnvelope->getEventType())
        );
        $this->eventBus->dispatch($domainEvent);
    }

    /**
     * @return class-string|null
     */
    private function getClassByType(string $type): ?string
    {
        return self::MAP[$type] ?? null;
    }
}
