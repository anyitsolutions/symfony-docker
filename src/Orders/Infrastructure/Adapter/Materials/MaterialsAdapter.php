<?php

declare(strict_types=1);

namespace App\Orders\Infrastructure\Adapter\Materials;

use App\Orders\Application\Service\Material\MaterialApiInterface;
use App\Orders\Application\Service\Material\MaterialDTO;
use App\Training\Infrastructure\Api\TrainingApi;

final class MaterialsAdapter implements MaterialApiInterface
{
    public function __construct(private TrainingApi $trainingApi)
    {
    }

    public function findMaterial(string $materialId): ?MaterialDTO
    {
        $material = $this->trainingApi->findMaterial($materialId);
        if (!$material) {
            return null;
        }

        return new MaterialDTO($material->id, $material->name, $material->price);
    }
}
