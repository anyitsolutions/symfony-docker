<?php

declare(strict_types=1);

namespace App\Inventory\Application\UseCase\Command\AddProduct;

use App\Shared\Application\Command\CommandInterface;

final readonly class AddProductCommand implements CommandInterface
{
    public function __construct(public string $productId, public int $quantity)
    {
    }
}
