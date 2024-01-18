<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Event;

use App\Shared\Domain\Service\UlidService;

class EventEnvelope
{
    public string $eventId;

    public int $eventTime;
    public string $eventType;
    public array $eventData;

    public function __construct(
        string $eventType,
        array $eventData
    ) {
        $this->eventId = UlidService::generate();
        $this->eventTime = time();
        $this->eventType = $eventType;
        $this->eventData = $eventData;
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getEventType(): string
    {
        return $this->eventType;
    }

    public function getEventTime(): int
    {
        return $this->eventTime;
    }

    public function getEventData(): array
    {
        return $this->eventData;
    }
}
