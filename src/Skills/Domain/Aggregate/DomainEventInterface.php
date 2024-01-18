<?php

declare(strict_types=1);

namespace App\Skills\Domain\Aggregate;

interface DomainEventInterface
{
    public function getType(): string;
}
