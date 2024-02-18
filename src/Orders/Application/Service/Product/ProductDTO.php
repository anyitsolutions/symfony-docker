<?php

declare(strict_types=1);

namespace App\Orders\Application\Service\Product;

final readonly class ProductDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public int $price,
    ) {
    }
}
