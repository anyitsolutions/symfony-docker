<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\ProductsReserved;

final readonly class ProductsReservedExternalEvent
{
    /**
     * @param array<string> $productIds
     */
    public function __construct(public array $productIds, public string $orderId)
    {
    }
}
