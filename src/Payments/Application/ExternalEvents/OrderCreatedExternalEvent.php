<?php

declare(strict_types=1);

namespace App\Payments\Application\ExternalEvents;

final class OrderCreatedExternalEvent
{
    /**
     * @param array{id: string, name: string, price: int, customerId: string} $items
     */
    public function __construct(private string $orderId, private string $customerId, private array $items, private int $totalPrice)
    {
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
