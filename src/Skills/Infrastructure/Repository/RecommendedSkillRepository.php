<?php

declare(strict_types=1);

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Aggregate\RecommendedSkill\RecommendedSkill;
use App\Skills\Domain\Aggregate\RecommendedSkill\RecommendedSkillRepositoryInterface;
use Psr\Cache\CacheItemPoolInterface;

final class RecommendedSkillRepository implements RecommendedSkillRepositoryInterface
{
    public function __construct(private readonly CacheItemPoolInterface $skillsCache)
    {
    }

    /**
     * @param array<RecommendedSkill> $recommendations
     */
    public function saveUserRecommendations(string $userId, array $recommendations): void
    {
        $item = $this->skillsCache->getItem($this->getKey($userId));
        $item->set($recommendations);
        $item->expiresAfter(\DateInterval::createFromDateString('1 year'));
        $this->skillsCache->save($item);
    }

    public function getRecommendedSkills(string $userId): array
    {
        $item = $this->skillsCache->getItem($this->getKey($userId));
        if ($item->isHit()) {
            return $item->get();
        }

        return [];
    }

    private function getKey(string $userId): string
    {
        return 'user_recommendations_'.$userId;
    }
}
