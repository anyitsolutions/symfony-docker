<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\ProductReservationRejected;

final readonly class ProductReservationRejectedExternalEvent
{
    /**
     * @param array<string> $productIds
     */
    public function __construct(public array $productIds, public string $orderId)
    {
    }
}
