<?php

declare(strict_types=1);

namespace App\Training\Domain\Aggregate;

interface DomainEventInterface
{
    public function getType(): string;
}
