<?php

declare(strict_types=1);

namespace App\Skills\Infrastructure\Event;

use App\Shared\Domain\Event\EventType;
use App\Skills\Application\Event\UserCreatedEvent\UserCreatedExternalEvent;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

#[AsMessageHandler]
final class EventEnvelopeHandler
{
    private const MAP = [
        EventType::USERS_USER_CREATED => UserCreatedExternalEvent::class,
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
