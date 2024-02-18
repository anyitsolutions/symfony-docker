<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\Service\Orchestrator;

interface StepInterface
{
    public function execute(string $orderId): void;

    public function compensate(string $orderId): void;
}
