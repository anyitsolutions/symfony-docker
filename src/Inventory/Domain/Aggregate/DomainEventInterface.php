<?php

declare(strict_types=1);

namespace App\Inventory\Domain\Aggregate;

interface DomainEventInterface
{
    public function getType(): string;
}
