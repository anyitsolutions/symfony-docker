<?php

declare(strict_types=1);

namespace App\Orders\Application\UseCase\Command\CreateOrder;

final readonly class CreateOrderCommandResult
{
    public function __construct(public string $orderId)
    {
    }
}
