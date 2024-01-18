<?php

declare(strict_types=1);

namespace App\Training\Domain\Aggregate\Material;

use App\Shared\Domain\Service\UlidService;

final class MaterialSkill
{
    private string $id;
    private string $skillId;
    private Material $material;

    public function __construct(
        string $skillId,
        Material $material,
    ) {
        $this->id = UlidService::generate();
        $this->skillId = $skillId;
        $this->material = $material;
    }
}
