<?php

declare(strict_types=1);

namespace App\Training\Application\DTO;

use App\Training\Domain\Aggregate\Material\Material;

final readonly class MaterialDTO
{
    public function __construct(public string $id, public string $name, public int $price)
    {
    }

    public static function fromEntity(Material $material): self
    {
        return new self($material->getId(), $material->getName(), $material->getPrice());
    }
}
