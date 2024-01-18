<?php

declare(strict_types=1);

namespace App\Training\Domain\Service;

use App\Training\Domain\Aggregate\Material\Material;
use App\Training\Domain\Aggregate\Material\MaterialRepositoryInterface;
use App\Training\Domain\Aggregate\Material\Type;
use App\Training\Domain\Factory\MaterialFactory;

final readonly class MaterialCreator
{
    public function __construct(
        private MaterialRepositoryInterface $materialRepository,
        private MaterialFactory $materialFactory,
    ) {
    }

    public function create(
        string $name,
        string $description,
        Type $type,
        int $price,
        array $skillIds = [],
    ): Material {
        $material = $this->materialFactory->create(
            name: $name,
            description: $description,
            type: $type,
            price: $price,
            skillIds: $skillIds,
        );
        $this->materialRepository->add($material);

        return $material;
    }
}
