<?php

declare(strict_types=1);

namespace App\Training\Infrastructure\Api;

use App\Training\Application\DTO\MaterialDTO;
use App\Training\Application\UseCase\TrainingUseCaseInteractor;

final class TrainingApi
{
    public function __construct(private TrainingUseCaseInteractor $trainingUseCaseInteractor)
    {
    }

    public function findMaterial(string $materialId): ?MaterialDTO
    {
        return $this->trainingUseCaseInteractor->getMaterial($materialId)->material;
    }
}
