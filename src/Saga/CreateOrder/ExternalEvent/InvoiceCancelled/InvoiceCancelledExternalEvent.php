<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\InvoiceCancelled;

final readonly class InvoiceCancelledExternalEvent
{
    public function __construct(public string $invoiceId, public string $orderId)
    {
    }
}
