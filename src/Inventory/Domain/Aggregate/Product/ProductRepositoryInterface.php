<?php

declare(strict_types=1);

namespace App\Inventory\Domain\Aggregate\Product;

interface ProductRepositoryInterface
{
    public function findOne(string $id): ?Product;

    public function save(Product $product): void;

    /**
     * @param array<string> $ids
     *
     * @return array<Product>
     */
    public function findProducts(array $ids): array;

    /**
     * @param array<Product> $products
     */
    public function saveBatch(array $products): void;
}
