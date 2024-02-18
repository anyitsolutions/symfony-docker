<?php

declare(strict_types=1);

namespace App\Orders\Application\Service\Product;

final class ProductService
{
    public function __construct(private ProductApiInterface $api)
    {
    }

    public function findProduct(string $productId): ?ProductDTO
    {
        return $this->api->findProduct($productId);
    }
}
