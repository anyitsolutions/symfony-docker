<?php

declare(strict_types=1);

namespace App\Payments\Application\UseCase\Command\CompletePayment;

use App\Payments\Application\Service\PaymentGateway\PaymentGatewayInterface;
use App\Payments\Domain\Aggregate\Payment\PaymentRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

final class CompletePaymentCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private PaymentRepositoryInterface $paymentRepository,
        private PaymentGatewayInterface $paymentGateway
    ) {
    }

    public function __invoke(CompletePaymentCommand $command): void
    {
        $payment = $this->paymentRepository->findOneByExternalId($command->externalPaymentId);
        if ($payment->isAwaiting()) {
            $status = $this->paymentGateway->checkStatus($payment->getExternalPaymentId());
            if ($status->isPaid()) {
                $payment->markPaid();
            } elseif ($status->isFailed()) {
                $payment->markFailed();
            }

            $payment->setResponse($status->response);
            $this->paymentRepository->save($payment);
        }
    }
}
