<?php

declare(strict_types=1);

namespace App\Orders\Application\UseCase\Command\CreateOrder;

use App\Orders\Application\Service\Product\ProductService;
use App\Orders\Domain\Aggregate\Order\Product;
use App\Orders\Domain\Aggregate\Order\ProductType;
use App\Orders\Domain\Service\OrderService;
use App\Shared\Application\Command\CommandHandlerInterface;

final readonly class CreateOrderCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private OrderService $orderService,
        private ProductService $productService
    ) {
    }

    public function __invoke(CreateOrderCommand $command): CreateOrderCommandResult
    {
        $product = $this->productService->findProduct($command->productId);
        $order = $this->orderService->createOrder(
            $command->customerId,
            new Product($product->id, $product->name, ProductType::MATERIAL),
            $product->price
        );

        return new CreateOrderCommandResult($order->getId());
    }
}
