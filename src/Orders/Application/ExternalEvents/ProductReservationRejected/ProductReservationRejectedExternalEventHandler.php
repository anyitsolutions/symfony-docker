<?php

declare(strict_types=1);

namespace App\Orders\Application\ExternalEvents\ProductReservationRejected;

use App\Orders\Domain\Service\OrderService;
use App\Shared\Application\Event\EventHandlerInterface;

final class ProductReservationRejectedExternalEventHandler implements EventHandlerInterface
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function __invoke(ProductReservationRejectedExternalEvent $event): void
    {
        $this->orderService->cancelOrder($event->orderId);
    }
}
