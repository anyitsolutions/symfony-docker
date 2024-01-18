<?php

declare(strict_types=1);

namespace App\Training\Domain\Aggregate\Material;

use App\Shared\Domain\Event\EventType;
use App\Training\Domain\Aggregate\DomainEventInterface;

final class MaterialCreatedDomainEvent implements DomainEventInterface
{
    public function __construct(public string $materialId)
    {
    }

    public function getType(): string
    {
        return EventType::TRAINING_MATERIAL_CREATED;
    }
}
