<?php

declare(strict_types=1);

namespace App\Payments\Application\Event;

use App\Payments\Domain\Aggregate\Payment\PaymentRepositoryInterface;
use App\Payments\Domain\Aggregate\Payment\PaymentWasPaidDomainEvent;
use App\Payments\Domain\Service\InvoiceService;
use App\Shared\Application\Event\EventHandlerInterface;

final readonly class PaymentWasPaidEventHandler implements EventHandlerInterface
{
    public function __construct(
        private InvoiceService $invoiceService,
        private PaymentRepositoryInterface $paymentRepository,
    ) {
    }

    public function __invoke(PaymentWasPaidDomainEvent $event): void
    {
        $payment = $this->paymentRepository->findOne($event->paymentId);
        $this->invoiceService->markPaid($payment->getInvoiceId());
    }
}
