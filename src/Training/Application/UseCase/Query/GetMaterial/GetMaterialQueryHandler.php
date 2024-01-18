<?php

declare(strict_types=1);

namespace App\Training\Application\UseCase\Query\GetMaterial;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Training\Application\DTO\MaterialDTO;
use App\Training\Domain\Aggregate\Material\MaterialRepositoryInterface;

final readonly class GetMaterialQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private MaterialRepositoryInterface $repository,
    ) {
    }

    public function __invoke(GetMaterialQuery $query): GetMaterialQueryResult
    {
        $material = $this->repository->findOneById($query->materialId);
        if (!$material) {
            return new GetMaterialQueryResult(null);
        }

        return new GetMaterialQueryResult(MaterialDTO::fromEntity($material));
    }
}
