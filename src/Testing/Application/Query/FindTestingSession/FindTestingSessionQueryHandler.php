<?php

namespace App\Testing\Application\Query\FindTestingSession;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Testing\Application\Query\DTO\TestingSessionDTO;
use App\Testing\Domain\Repository\TestingSessionRepositoryInterface;

readonly class FindTestingSessionQueryHandler implements QueryHandlerInterface
{
    public function __construct(private TestingSessionRepositoryInterface $testingSessionRepository)
    {
    }

    public function __invoke(FindTestingSessionQuery $query): FindTestingSessionQueryResult
    {
        $testingSession = $this->testingSessionRepository->findOneById($query->testingSessionId);

        return new FindTestingSessionQueryResult(
            $testingSession ? TestingSessionDTO::fromEntity($testingSession) : null
        );
    }
}
