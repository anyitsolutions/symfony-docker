<?php

declare(strict_types=1);

namespace App\Payments\Domain\Service;

use App\Payments\Domain\Aggregate\Invoice\Invoice;
use App\Payments\Domain\Aggregate\Invoice\InvoiceRepositoryInterface;
use App\Payments\Domain\Aggregate\Invoice\Item;
use App\Payments\Domain\Aggregate\Payment\PaymentMethod;
use App\Payments\Domain\Factory\InvoiceFactory;

final class InvoiceService
{
    public function __construct(
        private InvoiceFactory $invoiceFactory,
        private InvoiceRepositoryInterface $invoiceRepository
    ) {
    }

    public function markPaid(string $invoiceId): void
    {
        $invoice = $this->invoiceRepository->findOne($invoiceId);
        $invoice->markPaid();
        $this->invoiceRepository->save($invoice);
    }

    /**
     * @param array<Item> $items
     */
    public function create(string $orderId, string $customerId, int $amount, array $items, PaymentMethod $paymentMethod): Invoice
    {
        $invoice = $this->invoiceFactory->create($orderId, $customerId, $amount, $items, $paymentMethod);
        $this->invoiceRepository->save($invoice);

        return $invoice;
    }
}
