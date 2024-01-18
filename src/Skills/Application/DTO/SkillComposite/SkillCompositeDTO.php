<?php

declare(strict_types=1);

namespace App\Skills\Application\DTO\SkillComposite;

use App\Skills\Application\DTO\Skill\SkillDTO;

final class SkillCompositeDTO
{
    public function __construct(
        public ?SkillDTO $skill = null,
        public ?SkillConfirmationDTO $confirmation = null,
        public ?SkillRecommendationDTO $recommendation = null,
    ) {
    }
}
