<?php

namespace App\Skills\Domain\Repository;

use App\Skills\Domain\Aggregate\SkillConfirmation\Level;
use App\Skills\Domain\Aggregate\SkillConfirmation\SkillConfirmation;

interface SkillConfirmationRepositoryInterface
{
    public function findByLevel(string $skillId, string $specialistId, Level $level): ?SkillConfirmation;

    /**
     * @param array<string> $skillIds
     *
     * @return array<SkillConfirmation>
     */
    public function findActualByUser(string $userId, array $skillIds = []): array;

    public function add(SkillConfirmation $skillConfirmation): void;

    /**
     * @return array<SkillConfirmation>
     */
    public function getAllActual(): array;
}
