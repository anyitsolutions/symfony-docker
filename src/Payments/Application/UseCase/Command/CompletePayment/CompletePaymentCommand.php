<?php

declare(strict_types=1);

namespace App\Payments\Application\UseCase\Command\CompletePayment;

use App\Shared\Application\Command\CommandInterface;

final readonly class CompletePaymentCommand implements CommandInterface
{
    public function __construct(public string $externalPaymentId)
    {
    }
}
