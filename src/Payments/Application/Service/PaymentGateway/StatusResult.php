<?php

declare(strict_types=1);

namespace App\Payments\Application\Service\PaymentGateway;

final class StatusResult
{
    public function __construct(
        public array $response,
        public Status $status
    ) {
    }

    public function isPaid(): bool
    {
        return Status::PAID === $this->status;
    }

    public function isAwaitingPayment(): bool
    {
        return Status::AWAITING_PAYMENT === $this->status;
    }

    public function isFailed(): bool
    {
        return Status::FAILED === $this->status;
    }
}
