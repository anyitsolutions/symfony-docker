<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\ExternalEvent\OrderCompleted;

final readonly class OrderCompletedExternalEvent
{
    public function __construct(public string $orderId)
    {
    }
}
