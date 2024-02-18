<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\Service\Orchestrator\Steps;

use App\Saga\CreateOrder\Adapter\PaymentService;
use App\Saga\CreateOrder\Entity\State;
use App\Saga\CreateOrder\Service\Orchestrator\StepInterface;
use App\Saga\CreateOrder\Service\SagaStateService;

final readonly class PayOrderStep implements StepInterface
{
    public function __construct(private SagaStateService $sagaState, private PaymentService $paymentService)
    {
    }

    public function execute(string $orderId): void
    {
        $this->sagaState->addState($orderId, State::PAYMENT_PENDING);

        try {
            $this->paymentService->payOrder($orderId);
            $this->sagaState->addState($orderId, State::PAYMENT_CONFIRMED);
        } catch (\Exception $e) {
            $this->sagaState->addState($orderId, State::PAYMENT_REJECTED);
            throw $e;
        }
    }

    public function compensate(string $orderId): void
    {
        $this->paymentService->refundPayment($orderId);
    }
}
