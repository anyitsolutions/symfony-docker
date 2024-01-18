<?php

declare(strict_types=1);

namespace App\Orders\Application\Service\Material;

interface MaterialApiInterface
{
    public function findMaterial(string $materialId): ?MaterialDTO;
}
