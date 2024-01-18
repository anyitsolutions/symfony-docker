<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate;

interface DomainEventInterface
{
    public function getType(): string;
}
