<?php

declare(strict_types=1);

namespace App\Skills\Application\Event\SkillRecommendationsUpdated;

final class SkillRecommendationsUpdatedExternalEvent
{
    /**
     * @param array<array{skillId: string, score: float}> $skillRecommendations
     */
    public function __construct(public string $userId, public array $skillRecommendations)
    {
    }
}
