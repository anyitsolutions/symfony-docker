<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase;

use App\Shared\Application\Query\QueryBusInterface;
use App\Skills\Application\UseCase\Query\FindSkill\FindSkillQuery;
use App\Skills\Application\UseCase\Query\FindSkill\FindSkillQueryResult;
use App\Skills\Application\UseCase\Query\FindSpeciality\FindSpecialityQuery;
use App\Skills\Application\UseCase\Query\FindSpeciality\FindSpecialityQueryResult;
use App\Skills\Application\UseCase\Query\GetPagedSkillGroups\GetPagedSkillGroupsQuery;
use App\Skills\Application\UseCase\Query\GetPagedSkillGroups\GetPagedSkillGroupsQueryResult;
use App\Skills\Application\UseCase\Query\GetPagedSkills\GetPagedSkillsQuery;
use App\Skills\Application\UseCase\Query\GetPagedSkills\GetPagedSkillsQueryResult;
use App\Skills\Application\UseCase\Query\GetPagedSpecialities\GetPagedSpecialitiesQuery;
use App\Skills\Application\UseCase\Query\GetPagedSpecialities\GetPagedSpecialitiesQueryResult;
use App\Skills\Domain\Repository\SkillGroupsFilter;
use App\Skills\Domain\Repository\SkillsFilter;
use App\Skills\Domain\Repository\SpecialityFilter;

readonly class PublicUseCaseInteractor
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    public function getPagedSkills(SkillsFilter $filter): GetPagedSkillsQueryResult
    {
        $query = new GetPagedSkillsQuery($filter);

        return $this->queryBus->execute($query);
    }

    public function getPagedSkillGroups(SkillGroupsFilter $filter): GetPagedSkillGroupsQueryResult
    {
        $query = new GetPagedSkillGroupsQuery($filter);

        return $this->queryBus->execute($query);
    }

    public function getPagedSpecialities(SpecialityFilter $filter): GetPagedSpecialitiesQueryResult
    {
        $query = new GetPagedSpecialitiesQuery($filter);

        return $this->queryBus->execute($query);
    }

    public function findSpeciality(string $specialityId): FindSpecialityQueryResult
    {
        $query = new FindSpecialityQuery($specialityId);

        return $this->queryBus->execute($query);
    }

    public function findSkill(string $skillId): FindSkillQueryResult
    {
        $query = new FindSkillQuery($skillId);

        return $this->queryBus->execute($query);
    }
}
