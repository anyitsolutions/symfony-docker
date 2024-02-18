<?php

declare(strict_types=1);

namespace App\Orders\Domain\Factory;

use App\Orders\Domain\Aggregate\Order\Item;
use App\Orders\Domain\Aggregate\Order\Order;
use App\Orders\Domain\Aggregate\Order\PaymentMethod;
use App\Orders\Domain\Aggregate\Order\Product;

final class OrderFactory
{
    public function create(string $customerId, Product $product, int $price): Order
    {
        $order = new Order($customerId, $price, PaymentMethod::CARD);
        $order->setItems([new Item($order, $product, $price)]);

        return $order;
    }
}
