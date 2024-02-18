<?php

declare(strict_types=1);

namespace App\Saga\Event;

use App\Saga\CreateOrder\ExternalEvent\InvoiceCancelled\InvoiceCancelledExternalEvent;
use App\Saga\CreateOrder\ExternalEvent\InvoicePaid\InvoicePaidExternalEvent;
use App\Saga\CreateOrder\ExternalEvent\OrderCancelled\OrderCancelledExternalEvent;
use App\Saga\CreateOrder\ExternalEvent\OrderCompleted\OrderCompletedExternalEvent;
use App\Saga\CreateOrder\ExternalEvent\OrderCreated\OrderCreatedExternalEvent;
use App\Saga\CreateOrder\ExternalEvent\ProductReservationRejected\ProductReservationRejectedExternalEvent;
use App\Saga\CreateOrder\ExternalEvent\ProductsReserved\ProductsReservedExternalEvent;
use App\Shared\Domain\Event\EventType;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

#[AsMessageHandler]
final class EventEnvelopeHandler
{
    private const EVENT_MAP = [
        EventType::ORDERS_ORDER_CREATED => OrderCreatedExternalEvent::class,
        EventType::ORDERS_ORDER_CANCELLED => OrderCancelledExternalEvent::class,
        EventType::ORDERS_ORDER_COMPLETED => OrderCompletedExternalEvent::class,
        EventType::PAYMENTS_INVOICE_PAID => InvoicePaidExternalEvent::class,
        EventType::PAYMENTS_INVOICE_CANCELLED => InvoiceCancelledExternalEvent::class,
        EventType::INVENTORY_PRODUCTS_RESERVED => ProductsReservedExternalEvent::class,
        EventType::INVENTORY_PRODUCTS_RESERVATION_REJECTED => ProductReservationRejectedExternalEvent::class,
    ];

    public function __construct(private DenormalizerInterface $denormalizer, private MessageBusInterface $eventBus)
    {
    }

    public function __invoke(EventEnvelope $eventEnvelope): void
    {
        $class = self::EVENT_MAP[$eventEnvelope->getEventType()] ?? null;
        if (null === $class) {
            return;
        }

        $domainEvent = $this->denormalizer->denormalize($eventEnvelope->getEventData(), $class);
        $this->eventBus->dispatch($domainEvent);
    }
}
