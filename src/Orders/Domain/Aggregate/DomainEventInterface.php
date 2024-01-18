<?php

declare(strict_types=1);

namespace App\Orders\Domain\Aggregate;

interface DomainEventInterface
{
    public function getType(): string;
}
