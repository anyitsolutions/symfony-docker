<?php

declare(strict_types=1);

namespace App\Payments\Infrastructure\Service;

use App\Payments\Application\Service\PaymentGateway\PaymentGatewayInterface;
use App\Payments\Application\Service\PaymentGateway\PaymentResult;
use App\Payments\Application\Service\PaymentGateway\Status;
use App\Payments\Application\Service\PaymentGateway\StatusResult;
use App\Payments\Domain\Aggregate\Payment\Payment;

final class PaymentDummyGatewayService implements PaymentGatewayInterface
{
    public function pay(Payment $payment, ?string $returnUrl): PaymentResult
    {
        try {
            return new PaymentResult(
                bin2hex(random_bytes(16)),
                ['status' => 'success'],
                true,
                null
            );
        } catch (\Exception $e) {
            return new PaymentResult(
                null,
                [
                    'status' => 'failed',
                    'message' => $e->getMessage(),
                ],
                false,
                null
            );
        }
    }

    public function checkStatus(string $externalPaymentId): StatusResult
    {
        return new StatusResult(
            ['status' => 'paid'],
            Status::PAID
        );
    }
}
