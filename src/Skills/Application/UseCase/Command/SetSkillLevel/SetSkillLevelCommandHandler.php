<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Command\SetSkillLevel;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Skills\Application\DTO\SkillComposite\SkillConfirmationDTO;
use App\Skills\Domain\Aggregate\SkillConfirmation\Level;
use App\Skills\Domain\Service\SkillConfirmationService;

final class SetSkillLevelCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SkillConfirmationService $skillConfirmationService
    ) {
    }

    public function __invoke(SetSkillLevelCommand $command): SetSkillLevelCommandResult
    {
        $entity = $this->skillConfirmationService->confirm(
            $command->userId,
            $command->skillId,
            Level::from($command->level)
        );

        return new SetSkillLevelCommandResult(
            SkillConfirmationDTO::fromEntity($entity)
        );
    }
}
