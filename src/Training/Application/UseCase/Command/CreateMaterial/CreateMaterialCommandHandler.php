<?php

declare(strict_types=1);

namespace App\Training\Application\UseCase\Command\CreateMaterial;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Training\Application\DTO\MaterialDTO;
use App\Training\Domain\Aggregate\Material\Type;
use App\Training\Domain\Service\MaterialCreator;

final class CreateMaterialCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly MaterialCreator $materialCreator
    ) {
    }

    public function __invoke(CreateMaterialCommand $command): CreateMaterialCommandResult
    {
        $material = $this->materialCreator->create(
            name: $command->name,
            description: $command->description,
            type: Type::from($command->type),
            price: $command->price,
            skillIds: $command->skillIds,
        );

        return new CreateMaterialCommandResult(MaterialDTO::fromEntity($material));
    }
}
