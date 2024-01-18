<?php

declare(strict_types=1);

namespace App\Orders\Domain\Aggregate\Order;

/**
 * Тип продукта.
 */
enum ProductType: string
{
    case MATERIAL = 'material';
}
