<?php

declare(strict_types=1);

namespace App\Payments\Application\UseCase\Command\CreateInvoice;

use App\Payments\Domain\Aggregate\Invoice\Item;
use App\Payments\Domain\Aggregate\Payment\PaymentMethod;
use App\Shared\Application\Command\CommandInterface;

final readonly class CreateInvoiceCommand implements CommandInterface
{
    /**
     * @param array<Item> $items
     */
    public function __construct(
        public string $orderId,
        public string $customerId,
        public int $amount,
        public array $items,
        public PaymentMethod $paymentMethod
    ) {
    }
}
