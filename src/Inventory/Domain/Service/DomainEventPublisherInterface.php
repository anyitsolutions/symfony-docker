<?php

declare(strict_types=1);

namespace App\Inventory\Domain\Service;

use App\Inventory\Domain\Aggregate\DomainEventInterface;

interface DomainEventPublisherInterface
{
    public function publish(DomainEventInterface ...$events): void;
}
