<?php

declare(strict_types=1);

namespace App\Payments\Domain\Factory;

use App\Payments\Domain\Aggregate\Invoice\Invoice;
use App\Payments\Domain\Aggregate\Invoice\Item;
use App\Payments\Domain\Aggregate\Payment\PaymentMethod;

final class InvoiceFactory
{
    /**
     * @param array<Item> $items
     */
    public function create(string $orderId, string $customerId, int $amount, array $items, PaymentMethod $paymentMethod): Invoice
    {
        return new Invoice($orderId, $customerId, $amount, $items, $paymentMethod);
    }
}
