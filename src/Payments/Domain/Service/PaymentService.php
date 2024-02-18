<?php

declare(strict_types=1);

namespace App\Payments\Domain\Service;

use App\Payments\Domain\Aggregate\Payment\Payment;
use App\Payments\Domain\Aggregate\Payment\PaymentMethod;
use App\Payments\Domain\Aggregate\Payment\PaymentRepositoryInterface;
use App\Payments\Domain\Factory\PaymentFactory;

final readonly class PaymentService
{
    public function __construct(
        private PaymentRepositoryInterface $paymentRepository,
        private PaymentFactory $paymentFactory
    ) {
    }

    public function createPayment(
        string $invoiceId,
        string $customerId,
        int $amount,
        PaymentMethod $paymentMethod
    ): Payment {
        $payment = $this->paymentFactory->create($invoiceId, $customerId, $amount, $paymentMethod);
        $this->paymentRepository->save($payment);

        return $payment;
    }
}
