<?php

declare(strict_types=1);

namespace App\Training\Application\UseCase\Query\GetMaterial;

use App\Shared\Application\Query\QueryInterface;

final readonly class GetMaterialQuery implements QueryInterface
{
    public function __construct(public string $materialId)
    {
    }
}
