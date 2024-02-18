<?php

declare(strict_types=1);

namespace App\Orders\Application\UseCase;

use App\Orders\Application\UseCase\Command\CreateOrder\CreateOrderCommand;
use App\Orders\Application\UseCase\Command\CreateOrder\CreateOrderCommandResult;
use App\Shared\Application\Command\CommandBusInterface;

final class OrdersUseCase
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    public function createOrder(
        string $customerId,
        string $productId
    ): CreateOrderCommandResult {
        return $this->commandBus->execute(new CreateOrderCommand($customerId, $productId));
    }
}
