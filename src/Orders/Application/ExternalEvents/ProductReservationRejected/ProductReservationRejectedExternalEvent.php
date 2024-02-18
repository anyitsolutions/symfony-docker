<?php

declare(strict_types=1);

namespace App\Orders\Application\ExternalEvents\ProductReservationRejected;

final readonly class ProductReservationRejectedExternalEvent
{
    /**
     * @param array<string> $productIds
     */
    public function __construct(public array $productIds, public string $orderId)
    {
    }
}
