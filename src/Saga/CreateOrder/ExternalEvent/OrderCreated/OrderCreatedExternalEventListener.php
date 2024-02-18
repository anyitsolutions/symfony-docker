<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\OrderCreated;

use App\Saga\CreateOrder\Service\Choreography\CreateOrderChoreography;
use App\Shared\Application\Event\EventHandlerInterface;

final class OrderCreatedExternalEventListener implements EventHandlerInterface
{
    public function __construct(private CreateOrderChoreography $createOrderChoreographySagaService,
    ) {
    }

    public function __invoke(OrderCreatedExternalEvent $event): void
    {
        $this->createOrderChoreographySagaService->handleOrderCreatedEvent($event);
    }
}
