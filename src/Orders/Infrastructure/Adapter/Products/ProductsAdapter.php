<?php

declare(strict_types=1);

namespace App\Orders\Infrastructure\Adapter\Products;

use App\Orders\Application\Service\Product\ProductApiInterface;
use App\Orders\Application\Service\Product\ProductDTO;

final class ProductsAdapter implements ProductApiInterface
{
    public function findProduct(string $productId): ?ProductDTO
    {
        // Here we should call the real API to get the product data
        return new ProductDTO($productId, 'Product name', 100);
    }
}
