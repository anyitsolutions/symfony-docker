<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Command\SetSkillLevel;

use App\Skills\Application\DTO\SkillComposite\SkillConfirmationDTO;

final class SetSkillLevelCommandResult
{
    public function __construct(public SkillConfirmationDTO $skillConfirmationDTO)
    {
    }
}
