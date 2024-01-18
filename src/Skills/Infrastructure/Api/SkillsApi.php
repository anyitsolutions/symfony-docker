<?php

declare(strict_types=1);

namespace App\Skills\Infrastructure\Api;

use App\Skills\Application\DTO\Skill\SkillDTO;
use App\Skills\Application\DTO\SkillComposite\SkillConfirmationDTO;
use App\Skills\Application\UseCase\Command\ConfirmSpecialistSkill\ConfirmSpecialistSkillCommand;
use App\Skills\Application\UseCase\PrivateUseCaseInteractor;
use App\Skills\Application\UseCase\PublicUseCaseInteractor;
use App\Testing\Infrastructure\Adapter\SkillsApiInterface as TestingSkillsApiInterface;

final readonly class SkillsApi implements TestingSkillsApiInterface
{
    public function __construct(
        private PrivateUseCaseInteractor $commandInteractor,
        private PublicUseCaseInteractor $publicUseCaseInteractor,
        private PrivateUseCaseInteractor $privateUseCaseInteractor
    ) {
    }

    public function confirmSpecialistSkill(
        string $skillId,
        string $userId,
        string $testId,
        int $correctAnswersPercentage
    ): void {
        $this->commandInteractor->confirmSpecialistSkillByTest(
            new ConfirmSpecialistSkillCommand(
                $skillId, $userId, $testId, $correctAnswersPercentage
            )
        );
    }

    public function findSkill(string $skillId): ?SkillDTO
    {
        return $this->publicUseCaseInteractor->findSkill($skillId)->skill;
    }

    /**
     * @return array<SkillConfirmationDTO>
     */
    public function getAllSkillConfirmations(): array
    {
        return $this->privateUseCaseInteractor->getAllSkillConfirmations()->skillConfirmations;
    }
}
