<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\InvoicePaid;

final readonly class InvoicePaidExternalEvent
{
    public function __construct(public string $invoiceId, public string $orderId)
    {
    }
}
