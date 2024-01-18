<?php

namespace App\Skills\Domain\Factory;

use App\Skills\Domain\Aggregate\Skill\Skill;
use App\Skills\Domain\Aggregate\SkillConfirmation\Level;
use App\Skills\Domain\Aggregate\SkillConfirmation\SkillConfirmation;
use App\Skills\Domain\Aggregate\Specialist\Specialist;

class SkillConfirmationFactory
{
    public function __construct()
    {
    }

    public function create(Specialist $specialist, Skill $skill, Level $level): SkillConfirmation
    {
        return new SkillConfirmation($specialist, $skill, $level);
    }
}
