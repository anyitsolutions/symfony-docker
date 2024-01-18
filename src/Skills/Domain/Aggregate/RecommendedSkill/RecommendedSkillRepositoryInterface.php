<?php

declare(strict_types=1);

namespace App\Skills\Domain\Aggregate\RecommendedSkill;

interface RecommendedSkillRepositoryInterface
{
    /**
     * @param array<RecommendedSkill> $recommendations
     */
    public function saveUserRecommendations(string $userId, array $recommendations): void;

    /**
     * @return array<RecommendedSkill>
     */
    public function getRecommendedSkills(string $userId): array;
}
