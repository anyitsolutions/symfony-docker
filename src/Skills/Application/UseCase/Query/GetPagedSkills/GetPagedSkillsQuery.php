<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\GetPagedSkills;

use App\Shared\Application\Query\Query;
use App\Skills\Domain\Repository\SkillsFilter;

readonly class GetPagedSkillsQuery extends Query
{
    public function __construct(public SkillsFilter $filter)
    {
    }
}
