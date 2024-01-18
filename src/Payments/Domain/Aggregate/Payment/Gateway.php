<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Payment;

enum Gateway: string
{
    case YOOMONEY = 'yoomoney';
    case TINKOFF = 'tinkoff';
}
