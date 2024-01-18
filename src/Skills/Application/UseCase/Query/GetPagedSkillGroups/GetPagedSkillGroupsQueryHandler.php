<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\GetPagedSkillGroups;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\DTO\SkillGroup\SkillGroupDTOTransformer;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;

class GetPagedSkillGroupsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly SkillGroupRepositoryInterface $skillGroupRepository,
        private readonly SkillGroupDTOTransformer $skillGroupDTOHydrator
    ) {
    }

    public function __invoke(GetPagedSkillGroupsQuery $query): GetPagedSkillGroupsQueryResult
    {
        $paginator = $this->skillGroupRepository->findByFilter($query->filter);
        $skillGroups = $this->skillGroupDTOHydrator->fromEntityList($paginator->items);

        return new GetPagedSkillGroupsQueryResult($skillGroups, $query->filter->pager);
    }
}
