<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\Entity;

enum State: string
{
    /**
     * Создан.
     */
    case CREATED = 'created';

    /**
     * Ожидает подтверждения.
     */
    case RESERVATION_PENDING = 'reservation_pending';

    case RESERVATION_REJECTED = 'reservation_rejected';

    case RESERVATION_CONFIRMED = 'reservation_confirmed';

    case PAYMENT_PENDING = 'payment_pending';

    case PAYMENT_REJECTED = 'payment_rejected';

    case PAYMENT_CONFIRMED = 'payment_confirmed';

    case ORDER_COMPLETED = 'order_completed';
    case ORDER_CANCELLED = 'order_cancelled';
}
