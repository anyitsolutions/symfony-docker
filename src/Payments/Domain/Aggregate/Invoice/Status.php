<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Invoice;

/**
 * Статус счета на оплату.
 */
enum Status: string
{
    case CREATED = 'created';
    case PAID = 'paid';
    case CANCELLED = 'cancelled';

    public function isCreated(): bool
    {
        return self::CREATED === $this;
    }
}
