<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\OrderCreated;

final readonly class OrderCreatedExternalEvent
{
    public function __construct(
        public string $orderId,
        public string $customerId,
        public array $items,
        public int $totalPrice
    ) {
    }
}
