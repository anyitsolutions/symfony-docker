<?php

declare(strict_types=1);

namespace App\Skills\Application\DTO\Skill;

use App\Skills\Application\DTO\SkillGroup\SkillGroupDTO;
use App\Skills\Domain\Aggregate\Skill\Skill;

final readonly class SkillDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public SkillGroupDTO $skillGroup,
    ) {
    }

    public static function fromEntity(Skill $skill): SkillDTO
    {
        $skillGroup = new SkillGroupDTO();
        $skillGroup->id = $skill->getSkillGroup()->getId();
        $skillGroup->name = $skill->getSkillGroup()->getName();

        return new SkillDTO($skill->getId(), $skill->getName(), $skillGroup);
    }
}
