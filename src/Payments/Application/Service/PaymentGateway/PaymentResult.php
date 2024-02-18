<?php

declare(strict_types=1);

namespace App\Payments\Application\Service\PaymentGateway;

final readonly class PaymentResult
{
    public function __construct(
        public ?string $externalPaymentId,
        public array $response,
        public bool $success,
        public ?string $confirmationUrl
    ) {
    }
}
