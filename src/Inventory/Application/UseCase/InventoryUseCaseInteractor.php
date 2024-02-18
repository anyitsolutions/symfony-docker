<?php

declare(strict_types=1);

namespace App\Inventory\Application\UseCase;

use App\Inventory\Application\UseCase\Command\AddProduct\AddProductCommand;
use App\Inventory\Application\UseCase\Command\ReleaseReservedProducts\ReleaseReservedProductsCommand;
use App\Inventory\Application\UseCase\Command\ReserveProducts\ReserveProductsCommand;
use App\Shared\Application\Command\CommandBusInterface;

final class InventoryUseCaseInteractor
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    /**
     * @param array<string> $productIds
     */
    public function reserveItems(array $productIds, string $orderId): void
    {
        $this->commandBus->execute(new ReserveProductsCommand($productIds, $orderId));
    }

    public function releaseReservedProducts(string $orderId): void
    {
        $this->commandBus->execute(new ReleaseReservedProductsCommand($orderId));
    }

    public function addProduct(string $productId, int $quantity): void
    {
        $this->commandBus->execute(new AddProductCommand($productId, $quantity));
    }
}
