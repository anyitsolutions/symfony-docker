<?php

declare(strict_types=1);

namespace App\Testing\Infrastructure\Console;

use App\Testing\Application\TestingUseCaseInteractor;
use App\Testing\Domain\Aggregate\Test\DifficultyLevel;
use App\Testing\Domain\Factory\TestFactory;
use App\Testing\Domain\Repository\TestRepositoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:test',
)]
final class TestConsoleCommand extends Command
{
    public function __construct(
        private TestFactory $testFactory,
        private TestRepositoryInterface $testRepository,
        private TestingUseCaseInteractor $testingUseCaseInteractor,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $test = $this->testFactory->create(
            'asd',
            'Тестирование по PHP'.rand(1, 100000),
            'Тестирование по PHP',
            DifficultyLevel::EASY,
            1,
            null
        );
        $this->testRepository->add($test);

        $testingSessionId = $this->testingUseCaseInteractor->createTestingSession($test->getId(), '1');
        $this->testingUseCaseInteractor->complete($testingSessionId);

        return Command::SUCCESS;
    }
}
