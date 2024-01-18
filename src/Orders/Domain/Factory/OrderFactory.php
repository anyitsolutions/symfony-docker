<?php

declare(strict_types=1);

namespace App\Orders\Domain\Factory;

use App\Orders\Domain\Aggregate\Order\Item;
use App\Orders\Domain\Aggregate\Order\Order;
use App\Orders\Domain\Aggregate\Order\PaymentMethod;
use App\Orders\Domain\Aggregate\Order\Product;
use App\Orders\Domain\Aggregate\Order\ProductType;

final class OrderFactory
{
    public function createPurchaseOrderForPaidMaterial(string $customerId, string $materialId, string $materialName, int $price): Order
    {
        $order = new Order($customerId, $price, PaymentMethod::CARD);
        $order->create([
            new Item($order, new Product($materialId, $materialName, ProductType::MATERIAL), $price),
        ]);

        return $order;
    }
}
