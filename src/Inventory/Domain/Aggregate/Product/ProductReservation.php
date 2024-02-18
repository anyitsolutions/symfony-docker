<?php

declare(strict_types=1);

namespace App\Inventory\Domain\Aggregate\Product;

use App\Inventory\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Service\UlidService;

class ProductReservation extends AggregateRoot
{
    private string $id;
    private string $productId;
    private string $orderId;
    private int $quantity;

    public function __construct(string $productId, string $orderId, int $quantity)
    {
        $this->id = UlidService::generate();
        $this->productId = $productId;
        $this->orderId = $orderId;
        $this->quantity = $quantity;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
