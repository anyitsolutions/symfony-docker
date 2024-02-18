<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture\Payments;

use App\Payments\Domain\Aggregate\Invoice\Item;
use App\Payments\Domain\Aggregate\Payment\PaymentMethod;
use App\Payments\Domain\Factory\InvoiceFactory;
use App\Shared\Domain\Service\UlidService;
use App\Tests\Tools\FakerTools;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class InvoiceFixture extends Fixture
{
    use FakerTools;

    public const REFERENCE = 'invoice';

    public function __construct(
        private readonly InvoiceFactory $invoiceFactory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $orderId = UlidService::generate();
        $customerId = UlidService::generate();
        $items = [
            new Item(UlidService::generate(), $this->getFaker()->name(), $this->getFaker()->numberBetween(1, 100)),
        ];
        $invoice = $this->invoiceFactory->create($orderId, $customerId, 100, $items, PaymentMethod::CARD);

        $manager->persist($invoice);
        $manager->flush();

        $this->addReference(self::REFERENCE, $invoice);
    }
}
