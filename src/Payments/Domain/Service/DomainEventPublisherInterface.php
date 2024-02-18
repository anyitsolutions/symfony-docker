<?php

declare(strict_types=1);

namespace App\Payments\Domain\Service;

use App\Payments\Domain\Aggregate\DomainEventInterface;

interface DomainEventPublisherInterface
{
    public function publish(DomainEventInterface ...$events): void;
}
