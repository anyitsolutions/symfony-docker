<?php

declare(strict_types=1);

namespace App\Users\Domain\Aggregate\User;

use App\Shared\Domain\Event\EventType;
use App\Users\Domain\Aggregate\DomainEventInterface;

final readonly class UserCreatedDomainEvent implements DomainEventInterface
{
    public function __construct(public string $userId)
    {
    }

    public function getType(): string
    {
        return EventType::USERS_USER_CREATED;
    }
}
