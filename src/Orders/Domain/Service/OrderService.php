<?php

declare(strict_types=1);

namespace App\Orders\Domain\Service;

use App\Orders\Domain\Aggregate\Order\Order;
use App\Orders\Domain\Aggregate\Order\OrderCreatedEvent;
use App\Orders\Domain\Aggregate\Order\OrderRepositoryInterface;
use App\Orders\Domain\Aggregate\Order\Product;
use App\Orders\Domain\Factory\OrderFactory;

final class OrderService
{
    public function __construct(
        private OrderFactory $orderFactory,
        private DomainEventPublisherInterface $domainEventPublisher,
        private OrderRepositoryInterface $orderRepository
    ) {
    }

    public function createOrder(string $customerId, Product $product, int $price): Order
    {
        $order = $this->orderFactory->create($customerId, $product, $price);

        $items = array_map(
            fn ($item) => [
                'id' => $item->getProduct()->getId(),
                'name' => $item->getProduct()->getName(),
                'price' => $item->getPrice(),
            ],
            $order->getItems()->toArray()
        );

        $events = [
            new OrderCreatedEvent(
                $order->getId(),
                $customerId,
                $items,
                $order->getTotalPrice(),
                $order->getPaymentMethod()->value
            ),
        ];

        $this->domainEventPublisher->publish(...$events);
        $this->orderRepository->save($order);

        return $order;
    }

    public function markPaid(string $orderId): void
    {
        $order = $this->orderRepository->findOneById($orderId);
        $order->markAsPaid();
        $this->orderRepository->save($order);
    }

    public function cancelOrder(string $orderId): void
    {
        $order = $this->orderRepository->findOneById($orderId);
        $order->cancel();
        $this->orderRepository->save($order);
    }

    public function completeOrder(string $orderId): void
    {
        $order = $this->orderRepository->findOneById($orderId);
        $order->complete();
        $this->orderRepository->save($order);
    }
}
