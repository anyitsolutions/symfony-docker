<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Invoice;

use App\Payments\Domain\Aggregate\DomainEventInterface;
use App\Shared\Domain\Event\EventType;

final class InvoicePaidDomainEvent implements DomainEventInterface
{
    public function getType(): string
    {
        return EventType::PAYMENTS_INVOICE_PAID;
    }
}
