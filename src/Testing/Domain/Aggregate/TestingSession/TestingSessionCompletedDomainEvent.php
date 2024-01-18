<?php

declare(strict_types=1);

namespace App\Testing\Domain\Aggregate\TestingSession;

use App\Shared\Domain\Event\EventType;
use App\Testing\Domain\Aggregate\DomainEventInterface;

/**
 * Сессия тестирования завершена.
 */
readonly class TestingSessionCompletedDomainEvent implements DomainEventInterface
{
    public function __construct(public string $testingSessionId)
    {
    }

    public function getType(): string
    {
        return EventType::TESTING_TESTING_SESSION_COMPLETED;
    }
}
