<?php

declare(strict_types=1);

namespace App\Payments\Domain\Factory;

use App\Payments\Domain\Aggregate\Invoice\Invoice;
use App\Payments\Domain\Aggregate\Payment\Payment;
use App\Payments\Domain\Aggregate\Payment\PaymentMethod;

final class PaymentFactory
{
    public function create(string $invoiceId, string $customerId, int $amount, PaymentMethod $paymentMethod): Payment
    {
        return new Payment($invoiceId, $customerId, $amount, $paymentMethod);
    }

    public function createFromInvoice(Invoice $invoice): Payment
    {
        return new Payment($invoice->getId(), $invoice->getCustomerId(), $invoice->getAmount(), $invoice->getPaymentMethod());
    }
}
