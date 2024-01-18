<?php

declare(strict_types=1);

namespace App\Orders\Application\Service\Material;

final readonly class MaterialDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public int $price,
    ) {
    }
}
