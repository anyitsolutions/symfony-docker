<?php

declare(strict_types=1);

namespace App\Inventory\Application\ExternalEvents\InvoiceCancelled;

final class InvoiceCancelledExternalEvent
{
    public function __construct(private string $invoiceId, private string $orderId)
    {
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
