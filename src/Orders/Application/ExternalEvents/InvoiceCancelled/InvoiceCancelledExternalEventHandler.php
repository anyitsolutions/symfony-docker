<?php

declare(strict_types=1);

namespace App\Orders\Application\ExternalEvents\InvoiceCancelled;

use App\Orders\Domain\Service\OrderService;
use App\Shared\Application\Event\EventHandlerInterface;

final readonly class InvoiceCancelledExternalEventHandler implements EventHandlerInterface
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function __invoke(InvoiceCancelledExternalEvent $event): void
    {
        $this->orderService->cancelOrder($event->getOrderId());
    }
}
