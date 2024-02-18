<?php

namespace App\Tests\Functional\Payments\Application\UseCase\Command;

use App\Payments\Application\Service\PaymentGateway\PaymentGatewayInterface;
use App\Payments\Application\Service\PaymentGateway\Status;
use App\Payments\Application\Service\PaymentGateway\StatusResult;
use App\Payments\Application\UseCase\Command\CompletePayment\CompletePaymentCommand;
use App\Payments\Application\UseCase\Command\CompletePayment\CompletePaymentCommandHandler;
use App\Payments\Domain\Aggregate\Payment\PaymentRepositoryInterface;
use App\Tests\Tools\DITools;
use App\Tests\Tools\FakerTools;
use App\Tests\Tools\FixtureTools;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompletePaymentCommandTest extends WebTestCase
{
    use FakerTools;
    use DITools;
    use FixtureTools;

    private CompletePaymentCommandHandler $completePaymentCommandHandler;
    private PaymentRepositoryInterface $paymentRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->paymentRepository = $this->getService(PaymentRepositoryInterface::class);

        $paymentGateway = $this->createMock(PaymentGatewayInterface::class);
        $statusResult = new StatusResult(
            ['STATUS' => 'success'],
            Status::PAID
        );
        $paymentGateway->expects($this->once())
            ->method('checkStatus')
            ->willReturn($statusResult);
        $this->completePaymentCommandHandler = new CompletePaymentCommandHandler(
            $this->paymentRepository,
            $paymentGateway,
        );
    }

    public function test_paid_payment_completed_successfully(): void
    {
        $payment = $this->loadPaymentFixture();

        // act
        $this->completePaymentCommandHandler->__invoke(new CompletePaymentCommand($payment->getExternalPaymentId()));

        // assert
        $payment = $this->paymentRepository->findOneByExternalId($payment->getExternalPaymentId());
        $this->assertTrue($payment->isPaid());
    }
}
