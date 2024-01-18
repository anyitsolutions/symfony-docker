<?php

declare(strict_types=1);

namespace App\Orders\Application\UseCase\Command\CreateMaterialPurchaseOrder;

use App\Shared\Application\Command\CommandInterface;

final readonly class CreateMaterialPurchaseOrderCommand implements CommandInterface
{
    public function __construct(public string $customerId, public string $materialId)
    {
    }
}
