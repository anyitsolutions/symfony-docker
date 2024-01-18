<?php

declare(strict_types=1);

namespace App\Orders\Domain\Aggregate\Order;

interface OrderRepositoryInterface
{
    public function save(Order $order): void;
}
