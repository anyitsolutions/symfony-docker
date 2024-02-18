<?php

declare(strict_types=1);

namespace App\Payments\Application\UseCase;

use App\Payments\Application\UseCase\Command\CompletePayment\CompletePaymentCommand;
use App\Payments\Application\UseCase\Command\CreateInvoice\CreateInvoiceCommand;
use App\Payments\Application\UseCase\Command\PayInvoice\PayInvoiceCommand;
use App\Payments\Domain\Aggregate\Invoice\Item;
use App\Payments\Domain\Aggregate\Payment\PaymentMethod;
use App\Shared\Application\Command\CommandBusInterface;

final readonly class PaymentsUseCaseInteractor
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    /**
     * @param array<Item> $items
     */
    public function createInvoice(
        string $orderId,
        string $customerId,
        int $amount,
        array $items,
        PaymentMethod $paymentMethod
    ): void {
        $this->commandBus->execute(
            new CreateInvoiceCommand(
                $orderId, $customerId, $amount, $items, $paymentMethod
            )
        );
    }

    public function completePayment(string $externalPaymentId): void
    {
        $this->commandBus->execute(new CompletePaymentCommand($externalPaymentId));
    }

    public function payInvoice(string $invoiceId): void
    {
        $this->commandBus->execute(new PayInvoiceCommand($invoiceId, null));
    }
}
