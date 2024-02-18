<?php

declare(strict_types=1);

namespace App\Orders\Application\ExternalEvents\InvoicePaid;

final readonly class InvoicePaidExternalEvent
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
