<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateTestingSession;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Testing\Domain\Factory\TestingSessionFactory;
use App\Testing\Domain\Repository\TestingSessionRepositoryInterface;
use App\Testing\Domain\Repository\TestRepositoryInterface;

final readonly class CreateTestingSessionCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TestingSessionRepositoryInterface $testingSessionRepository,
        private TestingSessionFactory $testingSessionFactory,
        private TestRepositoryInterface $testRepository,
    ) {
    }

    public function __invoke(CreateTestingSessionCommand $command): string
    {
        $test = $this->testRepository->findOneById($command->testId);
        $testingSession = $this->testingSessionFactory->create($test, $command->userId);
        $this->testingSessionRepository->add($testingSession);

        return $testingSession->getId();
    }
}
