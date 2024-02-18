<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\ProductsReserved;

use App\Saga\CreateOrder\Service\Choreography\CreateOrderChoreography;
use App\Shared\Application\Event\EventHandlerInterface;

final class ProductsReservedExternalEventHandler implements EventHandlerInterface
{
    public function __construct(private CreateOrderChoreography $createOrderChoreographySagaService,
    ) {
    }

    public function __invoke(ProductsReservedExternalEvent $event): void
    {
        $this->createOrderChoreographySagaService->handleProductsReservedEvent($event);
    }
}
