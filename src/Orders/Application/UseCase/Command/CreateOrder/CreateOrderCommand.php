<?php

declare(strict_types=1);

namespace App\Orders\Application\UseCase\Command\CreateOrder;

use App\Shared\Application\Command\CommandInterface;

final readonly class CreateOrderCommand implements CommandInterface
{
    public function __construct(public string $customerId, public string $productId)
    {
    }
}
