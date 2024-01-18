<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\FindSkill;

use App\Skills\Application\DTO\Skill\SkillDTO;

readonly class FindSkillQueryResult
{
    public function __construct(public ?SkillDTO $skill)
    {
    }
}
