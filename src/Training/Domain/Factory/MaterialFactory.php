<?php

declare(strict_types=1);

namespace App\Training\Domain\Factory;

use App\Training\Domain\Aggregate\Material\Material;
use App\Training\Domain\Aggregate\Material\MaterialSkill;
use App\Training\Domain\Aggregate\Material\Type;

final readonly class MaterialFactory
{
    /**
     * @param array<string> $skillIds
     */
    public function create(
        string $name,
        string $description,
        Type $type,
        int $price,
        array $skillIds = [],
    ): Material {
        $material = new Material(
            name: $name,
            description: $description,
            type: $type,
        );
        $material->setPrice($price);

        foreach ($skillIds as $skillId) {
            $material->addSkill(new MaterialSkill($skillId, $material));
        }

        return $material;
    }
}
