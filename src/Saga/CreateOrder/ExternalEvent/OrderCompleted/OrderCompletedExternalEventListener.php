<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\OrderCompleted;

use App\Saga\CreateOrder\Service\Choreography\CreateOrderChoreography;
use App\Shared\Application\Event\EventHandlerInterface;

final class OrderCompletedExternalEventListener implements EventHandlerInterface
{
    public function __construct(private CreateOrderChoreography $createOrderChoreographySagaService,
    ) {
    }

    public function __invoke(OrderCompletedExternalEvent $event): void
    {
        $this->createOrderChoreographySagaService->handleOrderCompletedEvent($event);
    }
}
