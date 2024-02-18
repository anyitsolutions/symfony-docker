<?php

declare(strict_types=1);

namespace App\Orders\Application\Events\OrderPaid;

use App\Orders\Domain\Aggregate\Order\OrderPaidDomainEvent;
use App\Orders\Domain\Service\OrderService;
use App\Shared\Application\Event\EventHandlerInterface;

final readonly class OrderPaidEventListener implements EventHandlerInterface
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function __invoke(OrderPaidDomainEvent $event): void
    {
        $this->orderService->completeOrder($event->getOrderId());
    }
}
