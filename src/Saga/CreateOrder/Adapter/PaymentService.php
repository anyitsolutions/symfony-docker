<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\Adapter;

final class PaymentService
{
    public function refundPayment(string $orderId)
    {
    }

    public function payOrder(string $orderId)
    {
        throw new \Exception('Payment service is not available');
    }
}
