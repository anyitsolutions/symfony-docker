<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\Service;

use App\Saga\CreateOrder\Entity\CreateOrderSagaEntity;
use App\Saga\CreateOrder\Entity\State;
use App\Saga\CreateOrder\Repository\CreateOrderSagaRepository;

final readonly class SagaStateService
{
    public function __construct(private CreateOrderSagaRepository $repository)
    {
    }

    public function addState(string $orderId, State $state, object|array $payload = []): void
    {
        $sagaState = new CreateOrderSagaEntity(
            $orderId,
            $state,
            json_encode($payload)
        );
        $this->repository->save($sagaState);
    }

    public function getSaga(string $orderId): ?CreateOrderSagaEntity
    {
        return $this->repository->findLastState($orderId);
    }
}
