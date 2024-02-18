<?php

declare(strict_types=1);

namespace App\Inventory\Domain\Factory;

use App\Inventory\Domain\Aggregate\Product\ProductReservation;

final class ProductReservationFactory
{
    public function create(string $productId, string $orderId, int $quantity): ProductReservation
    {
        return new ProductReservation($productId, $orderId, $quantity);
    }
}
