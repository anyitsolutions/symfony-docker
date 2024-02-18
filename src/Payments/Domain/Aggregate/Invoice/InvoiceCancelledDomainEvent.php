<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Invoice;

use App\Payments\Domain\Aggregate\DomainEventInterface;
use App\Shared\Domain\Event\EventType;

final class InvoiceCancelledDomainEvent implements DomainEventInterface
{
    public function __construct(private string $invoiceId, private string $orderId)
    {
    }

    public function getType(): string
    {
        return EventType::PAYMENTS_INVOICE_CANCELLED;
    }

    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }
}
