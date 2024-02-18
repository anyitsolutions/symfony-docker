<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Payment;

/**
 * Статус платежа.
 */
enum Status: string
{
    case CREATED = 'created';
    case PAID = 'paid';
    case AWAITING_PAYMENT_CONFIRMATION = 'awaiting_payment_confirmation';
    case FAILED = 'failed';

    public function isAwaitingPaymentConfirmation(): bool
    {
        return self::AWAITING_PAYMENT_CONFIRMATION === $this;
    }
}
