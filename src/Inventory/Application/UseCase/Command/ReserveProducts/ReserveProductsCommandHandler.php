<?php

declare(strict_types=1);

namespace App\Inventory\Application\UseCase\Command\ReserveProducts;

use App\Inventory\Domain\Service\InventoryService;
use App\Shared\Application\Command\CommandHandlerInterface;

final class ReserveProductsCommandHandler implements CommandHandlerInterface
{
    public function __construct(private InventoryService $inventoryService)
    {
    }

    public function __invoke(ReserveProductsCommand $command): void
    {
        $this->inventoryService->reserve($command->productIds, $command->orderId);
    }
}
