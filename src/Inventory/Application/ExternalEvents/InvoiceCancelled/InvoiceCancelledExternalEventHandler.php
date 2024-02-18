<?php

declare(strict_types=1);

namespace App\Inventory\Application\ExternalEvents\InvoiceCancelled;

use App\Inventory\Application\UseCase\InventoryUseCaseInteractor;
use App\Shared\Application\Event\EventHandlerInterface;

final class InvoiceCancelledExternalEventHandler implements EventHandlerInterface
{
    public function __construct(private InventoryUseCaseInteractor $useCaseInteractor)
    {
    }

    public function __invoke(InvoiceCancelledExternalEvent $event): void
    {
        $this->useCaseInteractor->releaseReservedProducts($event->getOrderId());
    }
}
