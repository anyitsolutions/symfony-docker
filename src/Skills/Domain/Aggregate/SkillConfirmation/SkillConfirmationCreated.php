<?php

declare(strict_types=1);

namespace App\Skills\Domain\Aggregate\SkillConfirmation;

use App\Shared\Domain\Event\EventType;
use App\Skills\Domain\Aggregate\DomainEventInterface;

final readonly class SkillConfirmationCreated implements DomainEventInterface
{
    public function __construct(public string $skillConfirmationId, public string $userId, public string $skillId)
    {
    }

    public function getType(): string
    {
        return EventType::SKILLS_SKILL_CONFIRMATION_CREATED;
    }
}
