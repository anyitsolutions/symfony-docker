<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\ProductReservationRejected;

use App\Saga\CreateOrder\Service\Choreography\CreateOrderChoreography;
use App\Shared\Application\Event\EventHandlerInterface;

final class ProductReservationRejectedExternalEventHandler implements EventHandlerInterface
{
    public function __construct(private CreateOrderChoreography $createOrderChoreographySagaService,
    ) {
    }

    public function __invoke(ProductReservationRejectedExternalEvent $event): void
    {
        $this->createOrderChoreographySagaService->handleProductReservationRejectedEvent($event);
    }
}
