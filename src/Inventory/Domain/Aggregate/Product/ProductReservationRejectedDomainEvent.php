<?php

declare(strict_types=1);

namespace App\Inventory\Domain\Aggregate\Product;

use App\Inventory\Domain\Aggregate\DomainEventInterface;
use App\Shared\Domain\Event\EventType;

final readonly class ProductReservationRejectedDomainEvent implements DomainEventInterface
{
    /**
     * @param array<string> $productIds
     */
    public function __construct(public array $productIds, public string $orderId)
    {
    }

    public function getType(): string
    {
        return EventType::INVENTORY_PRODUCTS_RESERVATION_REJECTED;
    }
}
