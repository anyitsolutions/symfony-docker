<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\InvoicePaid;

use App\Saga\CreateOrder\Service\Choreography\CreateOrderChoreography;
use App\Shared\Application\Event\EventHandlerInterface;

final class InvoicePaidExternalEventHandler implements EventHandlerInterface
{
    public function __construct(private CreateOrderChoreography $createOrderChoreographySagaService,
    ) {
    }

    public function __invoke(InvoicePaidExternalEvent $event): void
    {
        $this->createOrderChoreographySagaService->handleInvoicePaidEvent($event);
    }
}
