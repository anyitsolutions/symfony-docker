<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Command\SetSkillLevel;

use App\Shared\Application\Command\CommandInterface;

final class SetSkillLevelCommand implements CommandInterface
{
    public function __construct(
        public string $skillId,
        public string $userId,
        public string $level,
    ) {
    }
}
