<?php

declare(strict_types=1);

namespace App\Payments\Application\Service\PaymentGateway;

enum Status: string
{
    case PAID = 'paid';
    case AWAITING_PAYMENT = 'awaiting_payment';
    case FAILED = 'failed';
}
