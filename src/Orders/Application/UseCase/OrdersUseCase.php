<?php

declare(strict_types=1);

namespace App\Orders\Application\UseCase;

use App\Orders\Application\UseCase\Command\CreateMaterialPurchaseOrder\CreateMaterialPurchaseOrderCommand;
use App\Shared\Application\Command\CommandBusInterface;

final class OrdersUseCase
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    public function createMaterialPurchaseOrder(string $customerId, string $materialId): void
    {
        $this->commandBus->execute(new CreateMaterialPurchaseOrderCommand($customerId, $materialId));
    }
}
