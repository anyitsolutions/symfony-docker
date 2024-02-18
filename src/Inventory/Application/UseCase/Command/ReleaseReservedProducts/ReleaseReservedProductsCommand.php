<?php

declare(strict_types=1);

namespace App\Inventory\Application\UseCase\Command\ReleaseReservedProducts;

use App\Shared\Application\Command\CommandInterface;

final readonly class ReleaseReservedProductsCommand implements CommandInterface
{
    public function __construct(public string $orderId)
    {
    }
}
