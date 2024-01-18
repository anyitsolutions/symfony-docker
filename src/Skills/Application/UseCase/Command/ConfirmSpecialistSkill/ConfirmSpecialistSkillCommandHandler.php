<?php

namespace App\Skills\Application\UseCase\Command\ConfirmSpecialistSkill;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Skills\Domain\Service\SkillConfirmationService;

readonly class ConfirmSpecialistSkillCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SkillConfirmationService $skillConfirmationService
    ) {
    }

    public function __invoke(ConfirmSpecialistSkillCommand $command): void
    {
        $this->skillConfirmationService->confirmByTest($command->userId, $command->skillId, $command->testId, $command->correctAnswersPercentage);
    }
}
