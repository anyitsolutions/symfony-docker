<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Payment;

use App\Payments\Domain\Aggregate\DomainEventInterface;
use App\Shared\Domain\Event\EventType;

final readonly class PaymentWasPaidDomainEvent implements DomainEventInterface
{
    public function __construct(public string $paymentId)
    {
    }

    public function getType(): string
    {
        return EventType::PAYMENTS_PAYMENT_PAID;
    }
}
