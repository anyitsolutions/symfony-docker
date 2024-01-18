<?php

declare(strict_types=1);

namespace App\Orders\Domain\Aggregate\Order;

final readonly class Product
{
    private string $id;
    private string $name;
    private ProductType $type;

    public function __construct(string $id, string $name, ProductType $type)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): ProductType
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
