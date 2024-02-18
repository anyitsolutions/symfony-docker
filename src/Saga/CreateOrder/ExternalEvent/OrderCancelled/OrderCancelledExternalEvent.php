<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\OrderCancelled;

final readonly class OrderCancelledExternalEvent
{
    public function __construct(public string $orderId)
    {
    }
}
