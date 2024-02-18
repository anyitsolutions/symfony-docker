<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\Service\Orchestrator\Steps;

use App\Saga\CreateOrder\Adapter\InventoryService;
use App\Saga\CreateOrder\Entity\State;
use App\Saga\CreateOrder\Service\Orchestrator\StepInterface;
use App\Saga\CreateOrder\Service\SagaStateService;

final readonly class ReserveProductsStep implements StepInterface
{
    public function __construct(private SagaStateService $sagaState, private InventoryService $inventoryService)
    {
    }

    public function execute(string $orderId): void
    {
        $this->sagaState->addState($orderId, State::RESERVATION_PENDING);

        try {
            $this->inventoryService->reserveProducts($orderId);
            $this->sagaState->addState($orderId, State::RESERVATION_CONFIRMED);
        } catch (\Exception $e) {
            $this->sagaState->addState($orderId, State::RESERVATION_REJECTED);
            throw $e;
        }
    }

    public function compensate(string $orderId): void
    {
        $this->inventoryService->releaseReservedProducts($orderId);
    }
}
