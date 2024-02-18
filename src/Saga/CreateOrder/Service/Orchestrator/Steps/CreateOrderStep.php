<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\Service\Orchestrator\Steps;

use App\Saga\CreateOrder\Adapter\OrderService;
use App\Saga\CreateOrder\Entity\State;
use App\Saga\CreateOrder\Service\Orchestrator\StepInterface;
use App\Saga\CreateOrder\Service\SagaStateService;

final readonly class CreateOrderStep implements StepInterface
{
    public function __construct(private SagaStateService $sagaState, private OrderService $orderService)
    {
    }

    public function execute(string $orderId): void
    {
    }

    public function compensate(string $orderId): void
    {
        $this->orderService->cancelOrder($orderId);
        $this->sagaState->addState($orderId, State::ORDER_CANCELLED);
    }
}
