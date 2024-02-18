<?php

declare(strict_types=1);

namespace App\Orders\Application\ExternalEvents\InvoicePaid;

use App\Orders\Domain\Service\OrderService;
use App\Shared\Application\Event\EventHandlerInterface;

final readonly class InvoicePaidExternalEventHandler implements EventHandlerInterface
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function __invoke(InvoicePaidExternalEvent $event): void
    {
        $this->orderService->markPaid($event->getOrderId());
    }
}
