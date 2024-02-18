<?php

declare(strict_types=1);

namespace App\Payments\Infrastructure\Event;

use App\Payments\Application\ExternalEvent\OrderCreated\OrderCreatedExternalEvent;
use App\Payments\Application\ExternalEvent\ProductsReserved\ProductsReservedExternalEvent;
use App\Payments\Domain\Aggregate\Payment\PaymentWasPaidDomainEvent;
use App\Shared\Domain\Event\EventType;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

#[AsMessageHandler]
final class EventEnvelopeHandler
{
    private const EVENT_MAP = [
        EventType::ORDERS_ORDER_CREATED => OrderCreatedExternalEvent::class,
        EventType::INVENTORY_PRODUCTS_RESERVED => ProductsReservedExternalEvent::class,
        EventType::PAYMENTS_PAYMENT_PAID => PaymentWasPaidDomainEvent::class,
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
