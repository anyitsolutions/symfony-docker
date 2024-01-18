<?php

declare(strict_types=1);

namespace App\Testing\Application;

use App\Shared\Application\Query\QueryBusInterface;
use App\Testing\Application\Query\FindAnswerOption\FindAnswerOptionQuery;
use App\Testing\Application\Query\FindAnswerOption\FindAnswerOptionQueryResult;
use App\Testing\Application\Query\FindQuestion\FindQuestionQuery;
use App\Testing\Application\Query\FindQuestion\FindQuestionQueryResult;
use App\Testing\Application\Query\FindTest\FindTestQuery;
use App\Testing\Application\Query\FindTest\FindTestQueryResult;
use App\Testing\Application\Query\FindTestingSession\FindTestingSessionQuery;
use App\Testing\Application\Query\FindTestingSession\FindTestingSessionQueryResult;

readonly class QueryInteractor
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    public function findTest(FindTestQuery $query): FindTestQueryResult
    {
        return $this->queryBus->execute($query);
    }

    public function findQuestion(FindQuestionQuery $query): FindQuestionQueryResult
    {
        return $this->queryBus->execute($query);
    }

    public function findAnswerOption(FindAnswerOptionQuery $query): FindAnswerOptionQueryResult
    {
        return $this->queryBus->execute($query);
    }

    public function findTestingSession(string $testingSessionId): FindTestingSessionQueryResult
    {
        return $this->queryBus->execute(new FindTestingSessionQuery($testingSessionId));
    }
}
