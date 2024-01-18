<?php

declare(strict_types=1);

namespace App\Training\Application\UseCase;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Training\Application\UseCase\Command\CreateMaterial\CreateMaterialCommand;
use App\Training\Application\UseCase\Command\CreateMaterial\CreateMaterialCommandResult;
use App\Training\Application\UseCase\Query\GetMaterial\GetMaterialQuery;
use App\Training\Application\UseCase\Query\GetMaterial\GetMaterialQueryResult;

final class TrainingUseCaseInteractor
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private CommandBusInterface $commandBus,
    ) {
    }

    public function createMaterial(
        string $name,
        string $description,
        string $type,
        int $price,
        array $skillIds = []
    ): CreateMaterialCommandResult {
        return $this->commandBus->execute(
            new CreateMaterialCommand(
                name: $name,
                description: $description,
                type: $type,
                price: $price,
                skillIds: $skillIds,
            )
        );
    }

    public function getMaterial(string $materialId): GetMaterialQueryResult
    {
        return $this->queryBus->execute(new GetMaterialQuery($materialId));
    }
}
