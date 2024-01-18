<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Invoice;

final readonly class Item
{
    public function __construct(public string $id, public string $name, public int $price)
    {
    }
}
