<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Invoice;

use App\Payments\Domain\Aggregate\AggregateRoot;
use App\Payments\Domain\Aggregate\Payment\PaymentMethod;
use App\Shared\Domain\Service\UlidService;

/**
 * Счет на оплату.
 */
class Invoice extends AggregateRoot
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
    private PaymentMethod $paymentMethod;

    private \DateTimeImmutable $createdAt;

    private ?\DateTime $updatedAt = null;

    /**
     * @param array<Item> $items
     */
    public function __construct(string $orderId, string $customerId, int $amount, array $items, PaymentMethod $paymentMethod)
    {
        $this->id = UlidService::generate();
        $this->orderId = $orderId;
        $this->customerId = $customerId;
        $this->status = Status::CREATED;
        $this->amount = $amount;
        $this->items = $items;
        $this->createdAt = new \DateTimeImmutable();
        $this->paymentMethod = $paymentMethod;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function markPaid(): void
    {
        $this->status = Status::PAID;
        $this->registerDomainEvent(new InvoicePaidDomainEvent('invoiceId', $this->orderId));
    }

    public function cancel(): void
    {
        $this->status = Status::CANCELLED;
        $this->registerDomainEvent(new InvoiceCancelledDomainEvent('invoiceId', $this->orderId));
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function isCreated(): bool
    {
        return $this->status->isCreated();
    }

    public function canPay(): bool
    {
        return $this->status->isCreated();
    }
}
