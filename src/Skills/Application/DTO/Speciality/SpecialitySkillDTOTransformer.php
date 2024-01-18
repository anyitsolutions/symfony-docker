<?php

declare(strict_types=1);

namespace App\Skills\Application\DTO\Speciality;

use App\Skills\Application\DTO\Skill\SkillDTO;
use App\Skills\Domain\Aggregate\Speciality\SpecialitySkill;

readonly class SpecialitySkillDTOTransformer
{
    public function fromEntity(SpecialitySkill $specialitySkill): SpecialitySkillDTO
    {
        $skillDTO = SkillDTO::fromEntity($specialitySkill->getSkill());

        return new SpecialitySkillDTO(
            id: $specialitySkill->getId(),
            specialityId: $specialitySkill->getId(),
            skill: $skillDTO,
            level: $specialitySkill->getLevel()->value,
        );
    }
}
