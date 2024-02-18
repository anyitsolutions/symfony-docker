<?php

declare(strict_types=1);

namespace App\Orders\Application\Service\Product;

interface ProductApiInterface
{
    public function findProduct(string $productId): ?ProductDTO;
}
