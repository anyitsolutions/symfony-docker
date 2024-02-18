<?php

declare(strict_types=1);

namespace App\Payments\Application\ExternalEvent\OrderCreated;

use App\Payments\Application\UseCase\PaymentsUseCaseInteractor;
use App\Payments\Domain\Aggregate\Invoice\Item;
use App\Payments\Domain\Aggregate\Payment\PaymentMethod;
use App\Shared\Application\Event\EventHandlerInterface;

final readonly class OrderCreatedExternalEventHandler implements EventHandlerInterface
{
    public function __construct(private PaymentsUseCaseInteractor $useCaseInteractor)
    {
    }

    public function __invoke(OrderCreatedExternalEvent $event): void
    {
        $items = array_map(
            static fn (array $item) => new Item($item['id'], $item['name'], $item['price']),
            $event->getItems()
        );
        $this->useCaseInteractor->createInvoice(
            $event->getOrderId(),
            $event->getCustomerId(),
            $event->getTotalPrice(),
            $items,
            PaymentMethod::from($event->getPaymentMethod())
        );
    }
}
