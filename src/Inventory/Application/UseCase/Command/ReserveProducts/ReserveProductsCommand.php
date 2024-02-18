<?php

declare(strict_types=1);

namespace App\Inventory\Application\UseCase\Command\ReserveProducts;

use App\Shared\Application\Command\CommandInterface;

final readonly class ReserveProductsCommand implements CommandInterface
{
    /**
     * @param array<string> $productIds
     */
    public function __construct(public array $productIds, public string $orderId)
    {
    }
}
