<?php

declare(strict_types=1);

namespace App\Orders\Domain\Aggregate\Order;

enum PaymentMethod: string
{
    case CARD = 'card';
}
