<?php

namespace App\Tests\Functional\Payments\Application\UseCase\Command;

use App\Payments\Application\UseCase\PaymentsUseCaseInteractor;
use App\Payments\Domain\Aggregate\Invoice\InvoiceRepositoryInterface;
use App\Payments\Domain\Aggregate\Invoice\Item;
use App\Payments\Domain\Aggregate\Payment\PaymentMethod;
use App\Shared\Domain\Service\UlidService;
use App\Tests\Tools\DITools;
use App\Tests\Tools\FakerTools;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateInvoiceCommandTest extends WebTestCase
{
    use FakerTools;
    use DITools;

    private PaymentsUseCaseInteractor $useCaseInteractor;
    private InvoiceRepositoryInterface $invoiceRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->useCaseInteractor = $this->getService(PaymentsUseCaseInteractor::class);
        $this->invoiceRepository = $this->getService(InvoiceRepositoryInterface::class);
    }

    public function test_invoice_created_successfully(): void
    {
        $orderId = UlidService::generate();
        $customerId = UlidService::generate();
        $amount = $this->getFaker()->randomNumber(2);
        $items = [
            new Item(
                UlidService::generate(),
                $this->getFaker()->word(),
                $this->getFaker()->randomNumber(5)
            ),
        ];

        // act
        $this->useCaseInteractor->createInvoice($orderId, $customerId, $amount, $items, PaymentMethod::CARD);

        // assert
        $invoice = $this->invoiceRepository->findOneByOrderId($orderId);
        $this->assertNotEmpty($invoice);
        $this->assertEquals($orderId, $invoice->getOrderId());
    }
}
