<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\Adapter;

final class InventoryService
{
    public function reserveProducts(string $orderId)
    {
    }

    public function releaseReservedProducts(string $orderId)
    {
    }
}
