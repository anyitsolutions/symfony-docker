<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Payment;

use App\Payments\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Service\UlidService;

class Payment extends AggregateRoot
{
    private string $id;
    private string $invoiceId;
    private string $customerId;
    private ?string $externalPaymentId = null;
    private Status $status;
    private PaymentMethod $paymentMethod;

    private int $amount;

    private array $response = [];

    private \DateTimeImmutable $createdAt;

    private ?\DateTime $updatedAt = null;

    public function __construct(string $invoiceId, string $customerId, int $amount, PaymentMethod $paymentMethod)
    {
        $this->id = UlidService::generate();
        $this->invoiceId = $invoiceId;
        $this->customerId = $customerId;
        $this->status = Status::CREATED;
        $this->amount = $amount;
        $this->paymentMethod = $paymentMethod;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function markPaid(): void
    {
        $this->status = Status::PAID;
        $this->registerDomainEvent(new PaymentWasPaidDomainEvent($this->id));
    }

    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getResponse(): array
    {
        return $this->response;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function getExternalPaymentId(): ?string
    {
        return $this->externalPaymentId;
    }

    public function setExternalPaymentId(?string $externalPaymentId): void
    {
        $this->externalPaymentId = $externalPaymentId;
    }

    public function setResponse(array $response): void
    {
        $this->response = $response;
    }

    public function markFailed(): void
    {
        $this->status = Status::FAILED;
    }

    public function markAwaitingPaymentConfirmation(): void
    {
        $this->status = Status::AWAITING_PAYMENT_CONFIRMATION;
    }

    public function isAwaiting(): bool
    {
        return Status::AWAITING_PAYMENT_CONFIRMATION === $this->status;
    }

    public function isPaid(): bool
    {
        return Status::PAID === $this->status;
    }
}
