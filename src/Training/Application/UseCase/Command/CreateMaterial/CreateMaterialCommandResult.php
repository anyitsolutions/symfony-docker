<?php

declare(strict_types=1);

namespace App\Training\Application\UseCase\Command\CreateMaterial;

use App\Training\Application\DTO\MaterialDTO;

final class CreateMaterialCommandResult
{
    public function __construct(public MaterialDTO $material)
    {
    }
}
