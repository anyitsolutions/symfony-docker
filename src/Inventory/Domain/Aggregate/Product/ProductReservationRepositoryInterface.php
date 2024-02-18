<?php

declare(strict_types=1);

namespace App\Inventory\Domain\Aggregate\Product;

interface ProductReservationRepositoryInterface
{
    /**
     * @param array<ProductReservation> $entities
     */
    public function saveBatch(array $entities): void;

    /**
     * @return array<ProductReservation>
     */
    public function findByOrderId(string $orderId): array;

    public function removeBatch(array $productReservations): void;
}
