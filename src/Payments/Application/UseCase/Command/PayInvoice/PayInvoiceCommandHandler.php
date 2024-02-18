<?php

declare(strict_types=1);

namespace App\Payments\Application\UseCase\Command\PayInvoice;

use App\Payments\Application\Service\PaymentGateway\PaymentGatewayInterface;
use App\Payments\Domain\Aggregate\Invoice\InvoiceRepositoryInterface;
use App\Payments\Domain\Aggregate\Payment\PaymentRepositoryInterface;
use App\Payments\Domain\Service\PaymentService;
use App\Shared\Application\Command\CommandHandlerInterface;
use Webmozart\Assert\Assert;

final readonly class PayInvoiceCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private PaymentService $paymentService,
        private InvoiceRepositoryInterface $invoiceRepository,
        private PaymentGatewayInterface $paymentGateway,
        private PaymentRepositoryInterface $paymentRepository
    ) {
    }

    public function __invoke(PayInvoiceCommand $command): PayInvoiceCommandResult
    {
        $invoice = $this->invoiceRepository->findOne($command->invoiceId);
        Assert::true($invoice->canPay(), 'Invoice cannot be paid');

        $payment = $this->paymentService->createPayment(
            $invoice->getId(),
            $invoice->getCustomerId(),
            $invoice->getAmount(),
            $invoice->getPaymentMethod()
        );

        $result = $this->paymentGateway->pay($payment, $command->returnUrl);
        if ($result->success) {
            $payment->setExternalPaymentId($result->externalPaymentId);
            $payment->markAwaitingPaymentConfirmation();
        } else {
            $payment->markFailed();
        }

        $payment->setResponse($result->response);
        $this->paymentRepository->save($payment);

        return new PayInvoiceCommandResult(
            $payment->getId(),
            $payment->getStatus(),
            $payment->getExternalPaymentId(),
            $result->confirmationUrl
        );
    }
}
