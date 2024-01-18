<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Invoice;

use App\Payments\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Service\UlidService;

/**
 * Счет на оплату.
 */
final class Invoice extends AggregateRoot
{
    private string $id;
    private string $orderId;
    private string $customerId;
    private Status $status;

    private int $amount;

    /**
     * @var array<Item>
     */
    private array $items;

    private \DateTimeImmutable $createdAt;

    private ?\DateTime $updatedAt = null;

    /**
     * @param array<Item> $items
     */
    public function __construct(string $orderId, string $customerId, int $amount, array $items)
    {
        $this->id = UlidService::generate();
        $this->orderId = $orderId;
        $this->customerId = $customerId;
        $this->status = Status::CREATED;
        $this->amount = $amount;
        $this->items = $items;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function paid(): void
    {
        $this->status = Status::PAID;
    }

    public function cancelled(): void
    {
        $this->status = Status::CANCELLED;
    }
}
