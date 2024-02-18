<?php

declare(strict_types=1);

namespace App\Payments\Application\UseCase\Command\PayInvoice;

use App\Payments\Domain\Aggregate\Payment\Status;

final readonly class PayInvoiceCommandResult
{
    public function __construct(
        public string $paymentId,
        public Status $status,
        public ?string $externalPaymentId,
        public ?string $confirmationUrl,
    ) {
    }
}
