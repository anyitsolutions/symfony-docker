<?php

declare(strict_types=1);

namespace App\Payments\Domain\Aggregate\Payment;

use App\Payments\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Service\UlidService;

final class Payment extends AggregateRoot
{
    private string $id;
    private string $invoiceId;
    private string $customerId;
    private Status $status;
    private Gateway $gateway;
    private string $externalTransactionId;

    private int $amount;

    private array $response;

    private \DateTimeImmutable $createdAt;

    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct(string $invoiceId, string $customerId, int $amount, Gateway $gateway)
    {
        $this->id = UlidService::generate();
        $this->invoiceId = $invoiceId;
        $this->customerId = $customerId;
        $this->status = Status::CREATED;
        $this->amount = $amount;
        $this->gateway = $gateway;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }
}
