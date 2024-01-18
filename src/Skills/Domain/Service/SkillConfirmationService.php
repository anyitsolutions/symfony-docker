<?php

namespace App\Skills\Domain\Service;

use App\Skills\Domain\Aggregate\SkillConfirmation\Level;
use App\Skills\Domain\Aggregate\SkillConfirmation\Proof;
use App\Skills\Domain\Aggregate\SkillConfirmation\SkillConfirmation;
use App\Skills\Domain\Factory\SkillConfirmationFactory;
use App\Skills\Domain\Repository\SkillConfirmationRepositoryInterface;
use App\Skills\Domain\Repository\SkillRepositoryInterface;
use App\Skills\Domain\Repository\SpecialistRepositoryInterface;

/**
 * Сервис подтверждения навыка.
 */
readonly class SkillConfirmationService
{
    public function __construct(
        private SpecialistRepositoryInterface $specialistRepository,
        private SkillRepositoryInterface $skillRepository,
        private SkillConfirmationFactory $skillConfirmationFactory,
        private SkillConfirmationRepositoryInterface $skillConfirmationRepository
    ) {
    }

    public function confirm(string $userId, string $skillId, Level $level): SkillConfirmation
    {
        $specialist = $this->specialistRepository->findOneByPublicUserId($userId);
        $skill = $this->skillRepository->findOneById($skillId);

        $skillConfirmation = $this->skillConfirmationRepository->findByLevel($skillId, $specialist->getId(), $level);
        if (!$skillConfirmation) {
            $skillConfirmation = $this->skillConfirmationFactory->create($specialist, $skill, $level);
        }

        $skillConfirmation->actual();
        $this->skillConfirmationRepository->add($skillConfirmation);

        return $skillConfirmation;
    }

    public function confirmByTest(string $userId, string $skillId, string $testId, int $correctAnswersPercentage): void
    {
        $specialist = $this->specialistRepository->findOneByPublicUserId($userId);
        $skill = $this->skillRepository->findOneById($skillId);
        $level = $this->makeLevelFromCorrectAnswersPercentage($correctAnswersPercentage);

        $skillConfirmation = $this->skillConfirmationRepository->findByLevel($skillId, $specialist->getId(), $level);
        if (!$skillConfirmation) {
            $skillConfirmation = $this->skillConfirmationFactory->create($specialist, $skill, $level);
        }

        // Добавляем док-во подтверждения навыка с помощью теста
        $skillConfirmation->addProof(new Proof($testId, $skillConfirmation));
        $skillConfirmation->actual();
        $this->skillConfirmationRepository->add($skillConfirmation);
    }

    /**
     * Создать значение уровня владения навыком исходя из ко-ва правильных ответов на тест.
     */
    private function makeLevelFromCorrectAnswersPercentage(int $correctAnswersPercentage): Level
    {
        if ($correctAnswersPercentage < 30) {
            $level = Level::BEGINNER;
        } elseif ($correctAnswersPercentage < 60) {
            $level = Level::INTERMEDIATE;
        } elseif ($correctAnswersPercentage < 90) {
            $level = Level::ADVANCED;
        } else {
            $level = Level::EXPERT;
        }

        return $level;
    }
}
