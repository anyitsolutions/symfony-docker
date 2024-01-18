<?php

declare(strict_types=1);

namespace App\Testing\Domain\Aggregate;

interface DomainEventInterface
{
    public function getType(): string;
}
