<?php

declare(strict_types=1);

namespace App\Orders\Domain\Aggregate\Customer;

use App\Shared\Domain\Service\UlidService;

/**
 * Покупатель.
 */
final class Customer
{
    private string $id;

    private string $publicUserId;
    private string $email;

    public function __construct(string $publicUserId, string $email)
    {
        $this->id = UlidService::generate();
        $this->email = $email;
        $this->publicUserId = $publicUserId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPublicUserId(): string
    {
        return $this->publicUserId;
    }
}
