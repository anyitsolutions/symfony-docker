<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Invoice;

interface InvoiceRepositoryInterface
{
    public function save(Invoice $invoice): void;

    public function findOne(string $invoiceId): ?Invoice;

    public function findOneByOrderId(string $orderId): ?Invoice;
}
