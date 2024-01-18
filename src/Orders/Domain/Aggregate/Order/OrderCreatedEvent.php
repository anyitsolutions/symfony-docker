<?php

declare(strict_types=1);

namespace App\Orders\Domain\Aggregate\Order;

use App\Orders\Domain\Aggregate\DomainEventInterface;
use App\Shared\Domain\Event\EventType;

final class OrderCreatedEvent implements DomainEventInterface
{
    public function __construct(
        private string $orderId,
        private string $customerId,
        private array $items,
        private int $totalPrice
    ) {
    }

    public function getType(): string
    {
        return EventType::ORDERS_ORDER_CREATED;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }
}
