<?php

declare(strict_types=1);

namespace App\Payments\Application\UseCase\Command\CreateInvoice;

use App\Payments\Domain\Service\InvoiceService;
use App\Shared\Application\Command\CommandHandlerInterface;

final readonly class CreateInvoiceCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private InvoiceService $invoiceService
    ) {
    }

    public function __invoke(CreateInvoiceCommand $command): void
    {
        $invoice = $this->invoiceService->create(
            $command->orderId,
            $command->customerId,
            $command->amount,
            $command->items,
            $command->paymentMethod
        );
    }
}
