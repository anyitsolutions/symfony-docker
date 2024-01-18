<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\GetPagedSkills;

use App\Shared\Domain\Repository\Pager;
use App\Skills\Application\DTO\SkillComposite\SkillCompositeDTO;

readonly class GetPagedSkillsQueryResult
{
    /**
     * @param array<SkillCompositeDTO> $skills
     */
    public function __construct(
        public array $skills,
        public Pager $pager
    ) {
    }
}
