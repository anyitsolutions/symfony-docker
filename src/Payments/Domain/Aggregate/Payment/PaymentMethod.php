<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Payment;

enum PaymentMethod: string
{
    case CARD = 'card';
}
