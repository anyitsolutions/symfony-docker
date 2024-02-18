<?php

declare(strict_types=1);

namespace App\Inventory\Domain\Service;

use App\Inventory\Domain\Aggregate\Product\ProductRepositoryInterface;
use App\Inventory\Domain\Factory\ProductFactory;

final readonly class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ProductFactory $productFactory
    ) {
    }

    public function add(string $productId, int $quantity): void
    {
        $product = $this->productFactory->create($productId, $quantity);
        $this->productRepository->save($product);
    }
}
