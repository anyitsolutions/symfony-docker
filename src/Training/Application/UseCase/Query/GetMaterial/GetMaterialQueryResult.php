<?php

declare(strict_types=1);

namespace App\Training\Application\UseCase\Query\GetMaterial;

use App\Training\Application\DTO\MaterialDTO;

final readonly class GetMaterialQueryResult
{
    public function __construct(public ?MaterialDTO $material)
    {
    }
}
