<?php

declare(strict_types=1);

namespace App\Orders\Domain\Service;

use App\Orders\Domain\Aggregate\DomainEventInterface;

interface DomainEventPublisherInterface
{
    public function publish(DomainEventInterface ...$events): void;
}
