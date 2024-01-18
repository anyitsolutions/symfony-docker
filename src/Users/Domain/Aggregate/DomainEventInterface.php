<?php

declare(strict_types=1);

namespace App\Users\Domain\Aggregate;

interface DomainEventInterface
{
    public function getType(): string;
}
