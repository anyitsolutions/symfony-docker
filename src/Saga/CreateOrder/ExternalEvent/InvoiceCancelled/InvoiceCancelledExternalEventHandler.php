<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\InvoiceCancelled;

use App\Saga\CreateOrder\Service\Choreography\CreateOrderChoreography;
use App\Shared\Application\Event\EventHandlerInterface;

final class InvoiceCancelledExternalEventHandler implements EventHandlerInterface
{
    public function __construct(private CreateOrderChoreography $createOrderChoreographySagaService,
    ) {
    }

    public function __invoke(InvoiceCancelledExternalEvent $event): void
    {
        $this->createOrderChoreographySagaService->handleInvoiceCancelledEvent($event);
    }
}
