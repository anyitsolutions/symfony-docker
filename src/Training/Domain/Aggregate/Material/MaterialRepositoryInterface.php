<?php

declare(strict_types=1);

namespace App\Training\Domain\Aggregate\Material;

interface MaterialRepositoryInterface
{
    public function add(Material $material): void;

    public function findOneById(string $materialId): ?Material;
}
