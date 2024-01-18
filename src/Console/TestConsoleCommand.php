<?php

declare(strict_types=1);

namespace App\Console;

use App\Orders\Application\UseCase\OrdersUseCase;
use App\Training\Application\UseCase\TrainingUseCaseInteractor;
use App\Training\Domain\Aggregate\Material\Type;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'orders:test',
)]
final class TestConsoleCommand extends Command
{
    public function __construct(
        private OrdersUseCase $ordersUseCase,
        private TrainingUseCaseInteractor $trainingUseCaseInteractor
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $material = $this->trainingUseCaseInteractor
            ->createMaterial('name', 'description', Type::VIDEO->value, 100)
            ->material;
        $this->ordersUseCase->createMaterialPurchaseOrder('customer_id', $material->id);

        return Command::SUCCESS;
    }
}
