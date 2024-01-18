<?php

namespace App\Skills\Domain\Aggregate\Skill\Specification;

use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Specification\SpecificationInterface;
use App\Skills\Domain\Aggregate\Skill\SkillGroup;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;

class SkillGroupNameSpecification implements SpecificationInterface
{
    public function __construct(
        private readonly SkillGroupRepositoryInterface $skillGroupRepository
    ) {
    }

    public function satisfy(SkillGroup $skillGroup): void
    {
        AssertService::lengthBetween($skillGroup->getName(), 2, 100);
        AssertService::true(
            empty($this->skillGroupRepository->findOneByName($skillGroup->getName())),
            'Название группы должно быть уникальным'
        );
    }
}
