<?php

declare(strict_types=1);

namespace App\Training\Application\UseCase\Command\CreateMaterial;

use App\Shared\Application\Command\CommandInterface;

final readonly class CreateMaterialCommand implements CommandInterface
{
    public function __construct(
        public string $name,
        public string $description,
        public string $type,
        public int $price,
        public array $skillIds = [],
    ) {
    }
}
