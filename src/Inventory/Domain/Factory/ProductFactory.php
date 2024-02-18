<?php

declare(strict_types=1);

namespace App\Inventory\Domain\Factory;

use App\Inventory\Domain\Aggregate\Product\Product;

final class ProductFactory
{
    public function create(string $productId, int $quantity): Product
    {
        return new Product($productId, $quantity);
    }
}
