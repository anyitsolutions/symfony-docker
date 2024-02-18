<?php

namespace App\Tests\Functional\Payments\Application\UseCase\Command;

use App\Payments\Application\Service\PaymentGateway\PaymentGatewayInterface;
use App\Payments\Application\Service\PaymentGateway\PaymentResult;
use App\Payments\Application\UseCase\Command\PayInvoice\PayInvoiceCommand;
use App\Payments\Application\UseCase\Command\PayInvoice\PayInvoiceCommandHandler;
use App\Payments\Domain\Aggregate\Invoice\InvoiceRepositoryInterface;
use App\Payments\Domain\Aggregate\Payment\PaymentRepositoryInterface;
use App\Payments\Domain\Service\PaymentService;
use App\Tests\Tools\DITools;
use App\Tests\Tools\FakerTools;
use App\Tests\Tools\FixtureTools;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PayInvoiceCommandTest extends WebTestCase
{
    use FakerTools;
    use DITools;
    use FixtureTools;

    private PayInvoiceCommandHandler $payInvoiceCommandHandler;
    private InvoiceRepositoryInterface $invoiceRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->invoiceRepository = $this->getService(InvoiceRepositoryInterface::class);

        $paymentGateway = $this->createMock(PaymentGatewayInterface::class);
        $paymentResult = new PaymentResult(
            'qwe',
            ['STATUS' => 'success'],
            true,
            $this->getFaker()->url()
        );
        $paymentGateway->expects($this->once())
            ->method('pay')
            ->willReturn($paymentResult);
        $this->payInvoiceCommandHandler = new PayInvoiceCommandHandler(
            $this->getService(PaymentService::class),
            $this->invoiceRepository,
            $paymentGateway,
            $this->getService(PaymentRepositoryInterface::class)
        );
    }

    /**
     * Платеж перешел в статус ожидания подтверждения оплаты.
     */
    public function test_payment_has_entered_awaiting_payment_confirmation_status(): void
    {
        $invoice = $this->loadInvoiceFixture();

        // act
        $paymentResult = $this->payInvoiceCommandHandler->__invoke(new PayInvoiceCommand($invoice->getId(), null));

        // assert
        $this->assertTrue($paymentResult->status->isAwaitingPaymentConfirmation());
    }
}
