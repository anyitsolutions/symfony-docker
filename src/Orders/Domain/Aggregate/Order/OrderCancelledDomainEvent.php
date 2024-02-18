<?php

declare(strict_types=1);

namespace App\Orders\Domain\Aggregate\Order;

use App\Orders\Domain\Aggregate\DomainEventInterface;
use App\Shared\Domain\Event\EventType;

final class OrderCancelledDomainEvent implements DomainEventInterface
{
    public function __construct(private string $orderId)
    {
    }

    public function getType(): string
    {
        return EventType::ORDERS_ORDER_CANCELLED;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }
}
