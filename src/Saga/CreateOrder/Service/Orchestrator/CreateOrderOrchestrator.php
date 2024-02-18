<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\Service\Orchestrator;

use App\Saga\CreateOrder\Service\Orchestrator\Steps\CreateOrderStep;
use App\Saga\CreateOrder\Service\Orchestrator\Steps\PayOrderStep;
use App\Saga\CreateOrder\Service\Orchestrator\Steps\ReserveProductsStep;

final readonly class CreateOrderOrchestrator
{
    public function __construct(
        private CreateOrderStep $createOrderStep,
        private ReserveProductsStep $reserveProductsStep,
        private PayOrderStep $payOrderStep
    ) {
    }

    public function run(string $orderId): void
    {
        /** @var StepInterface[] $steps */
        $steps = [
            $this->createOrderStep,
            $this->reserveProductsStep,
            $this->payOrderStep,
        ];

        /** @var StepInterface[] $compensatingSteps */
        $compensatingSteps = [];
        foreach ($steps as $step) {
            try {
                $step->execute($orderId);
                array_unshift($compensatingSteps, $step);
            } catch (\Exception $e) {
                $this->compensate($orderId, $compensatingSteps);
                break;
            }
        }
    }

    /**
     * @param StepInterface[] $compensatingSteps
     */
    private function compensate(string $orderId, array $compensatingSteps): void
    {
        foreach ($compensatingSteps as $step) {
            $step->compensate($orderId);
        }
    }
}
