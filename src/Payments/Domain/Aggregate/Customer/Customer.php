<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Customer;

use App\Shared\Domain\Service\UlidService;

/**
 * Покупатель.
 */
final class Customer
{
    private string $id;

    private string $publicUserId;

    public function __construct(string $publicUserId)
    {
        $this->id = UlidService::generate();
        $this->publicUserId = $publicUserId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPublicUserId(): string
    {
        return $this->publicUserId;
    }
}
