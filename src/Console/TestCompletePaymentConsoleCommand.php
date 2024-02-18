<?php

declare(strict_types=1);

namespace App\Console;

use App\Payments\Application\UseCase\PaymentsUseCaseInteractor;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'payments:test',
)]
final class TestCompletePaymentConsoleCommand extends Command
{
    public function __construct(
        private PaymentsUseCaseInteractor $paymentsUseCaseInteractor,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->paymentsUseCaseInteractor->completePayment('ff1605cadc83ee2595f4f27bd70a3609');

        return Command::SUCCESS;
    }
}
