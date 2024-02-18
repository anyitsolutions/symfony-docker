<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\Service\Choreography;

use App\Saga\CreateOrder\Entity\State;
use App\Saga\CreateOrder\ExternalEvent\InvoiceCancelled\InvoiceCancelledExternalEvent;
use App\Saga\CreateOrder\ExternalEvent\InvoicePaid\InvoicePaidExternalEvent;
use App\Saga\CreateOrder\ExternalEvent\OrderCancelled\OrderCancelledExternalEvent;
use App\Saga\CreateOrder\ExternalEvent\OrderCompleted\OrderCompletedExternalEvent;
use App\Saga\CreateOrder\ExternalEvent\OrderCreated\OrderCreatedExternalEvent;
use App\Saga\CreateOrder\ExternalEvent\ProductReservationRejected\ProductReservationRejectedExternalEvent;
use App\Saga\CreateOrder\ExternalEvent\ProductsReserved\ProductsReservedExternalEvent;
use App\Saga\CreateOrder\Service\SagaStateService;

final readonly class CreateOrderChoreography
{
    public function __construct(private SagaStateService $sagaState)
    {
    }

    public function handleOrderCreatedEvent(OrderCreatedExternalEvent $event): void
    {
        $this->addState($event->orderId, State::RESERVATION_PENDING, $event);
    }

    public function handleProductsReservedEvent(ProductsReservedExternalEvent $event): void
    {
        $this->addState($event->orderId, State::RESERVATION_CONFIRMED, $event);
        $this->addState($event->orderId, State::PAYMENT_PENDING, $event);
    }

    public function handleProductReservationRejectedEvent(ProductReservationRejectedExternalEvent $event): void
    {
        $this->addState($event->orderId, State::RESERVATION_REJECTED, $event);
    }

    public function handleInvoicePaidEvent(InvoicePaidExternalEvent $event): void
    {
        $this->addState($event->orderId, State::PAYMENT_CONFIRMED, $event);
    }

    public function handleInvoiceCancelledEvent(InvoiceCancelledExternalEvent $event): void
    {
        $this->addState($event->orderId, State::PAYMENT_REJECTED, $event);
    }

    public function handleOrderCompletedEvent(OrderCompletedExternalEvent $event): void
    {
        $this->addState($event->orderId, State::ORDER_COMPLETED, $event);
    }

    public function handleOrderCancelledEvent(OrderCancelledExternalEvent $event): void
    {
        $this->addState($event->orderId, State::ORDER_CANCELLED, $event);
    }

    public function addState(string $orderId, State $state, object|array $payload = []): void
    {
        $this->sagaState->addState($orderId, $state, $payload);
    }
}
