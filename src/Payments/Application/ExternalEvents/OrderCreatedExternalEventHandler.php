<?php

declare(strict_types=1);

namespace App\Payments\Application\ExternalEvents;

use App\Payments\Domain\Aggregate\Invoice\InvoiceRepositoryInterface;
use App\Payments\Domain\Aggregate\Invoice\Item;
use App\Payments\Domain\Factory\InvoiceFactory;
use App\Shared\Application\Event\EventHandlerInterface;

final class OrderCreatedExternalEventHandler implements EventHandlerInterface
{
    public function __construct(
        private InvoiceRepositoryInterface $invoiceRepository,
        private InvoiceFactory $invoiceFactory
    ) {
    }

    public function __invoke(OrderCreatedExternalEvent $event): void
    {
        $items = [];
        foreach ($event->getItems() as $item) {
            $items[] = new Item($item['id'], $item['name'], $item['price']);
        }
        $invoice = $this->invoiceFactory->create(
            $event->getOrderId(),
            $event->getCustomerId(),
            $event->getTotalPrice(),
            $items
        );
        $this->invoiceRepository->save($invoice);
    }
}
