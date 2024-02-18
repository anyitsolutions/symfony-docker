<?php

declare(strict_types=1);

namespace App\Payments\Application\UseCase\Command\PayInvoice;

use App\Shared\Application\Command\CommandInterface;

final readonly class PayInvoiceCommand implements CommandInterface
{
    public function __construct(public string $invoiceId, public ?string $returnUrl)
    {
    }
}
