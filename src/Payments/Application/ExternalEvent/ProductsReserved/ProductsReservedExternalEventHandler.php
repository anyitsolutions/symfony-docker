<?php

declare(strict_types=1);

namespace App\Payments\Application\ExternalEvent\ProductsReserved;

use App\Payments\Application\UseCase\PaymentsUseCaseInteractor;
use App\Payments\Domain\Aggregate\Invoice\InvoiceRepositoryInterface;
use App\Shared\Application\Event\EventHandlerInterface;

final readonly class ProductsReservedExternalEventHandler implements EventHandlerInterface
{
    public function __construct(
        private PaymentsUseCaseInteractor $useCaseInteractor,
        private InvoiceRepositoryInterface $invoiceRepository
    ) {
    }

    public function __invoke(ProductsReservedExternalEvent $event): void
    {
        $invoice = $this->invoiceRepository->findOneByOrderId($event->getOrderId());
        $this->useCaseInteractor->payInvoice($invoice->getId());
    }
}
