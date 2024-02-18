<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Payment;

interface PaymentRepositoryInterface
{
    public function save(Payment $payment): void;

    public function findOne(string $paymentId): ?Payment;

    public function findOneByExternalId(string $externalPaymentId): ?Payment;
}
