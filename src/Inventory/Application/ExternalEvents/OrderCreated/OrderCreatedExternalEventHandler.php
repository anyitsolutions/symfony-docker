<?php

declare(strict_types=1);

namespace App\Inventory\Application\ExternalEvents\OrderCreated;

use App\Inventory\Application\UseCase\InventoryUseCaseInteractor;
use App\Shared\Application\Event\EventHandlerInterface;

final readonly class OrderCreatedExternalEventHandler implements EventHandlerInterface
{
    public function __construct(private InventoryUseCaseInteractor $useCaseInteractor)
    {
    }

    public function __invoke(OrderCreatedExternalEvent $event): void
    {
        $itemIds = array_map(fn ($item) => $item['id'], $event->getItems());
        $this->useCaseInteractor->reserveItems($itemIds, $event->getOrderId());
    }
}
