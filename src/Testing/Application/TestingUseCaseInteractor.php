<?php

declare(strict_types=1);

namespace App\Testing\Application;

use App\Shared\Application\Command\CommandBusInterface;
use App\Testing\Application\Command\CompleteTestingSession\CompleteTestingSessionCommand;
use App\Testing\Application\Command\CreateTestingSession\CreateTestingSessionCommand;

final readonly class TestingUseCaseInteractor
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    public function createTestingSession(string $testId, string $userId): string
    {
        $command = new CreateTestingSessionCommand(
            testId: $testId,
            userId: $userId,
        );

        return $this->commandBus->execute($command);
    }

    public function complete(string $testingSessionId): void
    {
        $command = new CompleteTestingSessionCommand(
            testingSessionId: $testingSessionId,
        );
        $this->commandBus->execute($command);
    }
}
