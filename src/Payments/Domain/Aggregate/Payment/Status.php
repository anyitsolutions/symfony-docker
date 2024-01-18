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
    case REJECTED = 'rejected';
}
