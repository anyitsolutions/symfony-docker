<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture\Payments;

use App\Payments\Domain\Aggregate\Invoice\Invoice;
use App\Payments\Domain\Factory\PaymentFactory;
use App\Tests\Tools\FakerTools;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class PaymentFixture extends Fixture implements DependentFixtureInterface
{
    use FakerTools;

    public const REFERENCE = 'payment';

    public function __construct(
        private readonly PaymentFactory $paymentFactory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        /**
         * @var Invoice $invoice
         */
        $invoice = $this->getReference(InvoiceFixture::REFERENCE);
        $payment = $this->paymentFactory->createFromInvoice($invoice);
        $payment->setExternalPaymentId($this->getFaker()->uuid());
        $payment->markAwaitingPaymentConfirmation();

        $manager->persist($payment);
        $manager->flush();

        $this->addReference(self::REFERENCE, $payment);
    }

    public function getDependencies()
    {
        return [
            InvoiceFixture::class,
        ];
    }
}
