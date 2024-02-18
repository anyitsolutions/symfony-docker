<?php

declare(strict_types=1);

namespace App\Inventory\Domain\Aggregate\Product;

use App\Inventory\Domain\Aggregate\AggregateRoot;
use Webmozart\Assert\Assert;

class Product extends AggregateRoot
{
    public string $id;
    public int $quantity;

    public function __construct(string $id, int $quantity)
    {
        $this->id = $id;
        $this->quantity = $quantity;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function inStock(): bool
    {
        return $this->quantity > 0;
    }

    public function reserve(int $number): void
    {
        Assert::greaterThan($this->quantity, $number, 'The number of products to reserve should be less than the quantity in stock');
        $this->quantity -= $number;
    }

    public function release(int $number): void
    {
        $this->quantity += $number;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
