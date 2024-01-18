<?php

declare(strict_types=1);

namespace App\Orders\Domain\Aggregate\Order;

enum OrderStatus: string
{
    case CREATED = 'created';
    case PAID = 'paid';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}
