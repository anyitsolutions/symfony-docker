<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\OrderCancelled;

use App\Saga\CreateOrder\Service\Choreography\CreateOrderChoreography;
use App\Shared\Application\Event\EventHandlerInterface;

final class OrderCancelledExternalEventListener implements EventHandlerInterface
{
    public function __construct(private CreateOrderChoreography $createOrderChoreographySagaService,
    ) {
    }

    public function __invoke(OrderCancelledExternalEvent $event): void
    {
        $this->createOrderChoreographySagaService->handleOrderCancelledEvent($event);
    }
}
