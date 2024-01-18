<?php

declare(strict_types=1);

namespace App\Orders\Domain\Aggregate\Order;

use App\Shared\Domain\Service\UlidService;

/**
 * Позиция заказа.
 */
final class Item
{
    private string $id;
    private Order $order;
    private Product $product;
    private int $price;
    private \DateTimeImmutable $createdAt;

    public function __construct(Order $order, Product $product, int $price)
    {
        $this->id = UlidService::generate();
        $this->order = $order;
        $this->product = $product;
        $this->price = $price;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
