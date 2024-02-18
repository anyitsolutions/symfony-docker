<?php

declare(strict_types=1);

namespace App\Payments\Application\Service\PaymentGateway;

use App\Payments\Domain\Aggregate\Payment\Payment;

interface PaymentGatewayInterface
{
    public function pay(Payment $payment, ?string $returnUrl): PaymentResult;

    public function checkStatus(string $externalPaymentId): StatusResult;
}
