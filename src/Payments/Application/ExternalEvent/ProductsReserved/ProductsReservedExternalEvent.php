<?php

declare(strict_types=1);

namespace App\Payments\Application\ExternalEvent\ProductsReserved;

final readonly class ProductsReservedExternalEvent
{
    /**
     * @param array<string> $productIds
     */
    public function __construct(public array $productIds, public string $orderId)
    {
    }

    public function getProductIds(): array
    {
        return $this->productIds;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }
}
