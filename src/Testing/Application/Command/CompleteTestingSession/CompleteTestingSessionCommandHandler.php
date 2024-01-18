<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CompleteTestingSession;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Testing\Domain\Repository\TestingSessionRepositoryInterface;

final class CompleteTestingSessionCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TestingSessionRepositoryInterface $testingSessionRepository,
    ) {
    }

    public function __invoke(CompleteTestingSessionCommand $command): void
    {
        $testingSession = $this->testingSessionRepository->findOneById($command->testingSessionId);
        $testingSession->complete();
        $this->testingSessionRepository->add($testingSession);
    }
}
