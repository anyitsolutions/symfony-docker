<?php

declare(strict_types=1);

namespace App\Inventory\Application\UseCase\Command\ReleaseReservedProducts;

use App\Inventory\Domain\Service\InventoryService;
use App\Shared\Application\Command\CommandHandlerInterface;

final class ReleaseReservedProductsCommandHandler implements CommandHandlerInterface
{
    public function __construct(private InventoryService $inventoryService)
    {
    }

    public function __invoke(ReleaseReservedProductsCommand $command): void
    {
        $this->inventoryService->release($command->orderId);
    }
}
