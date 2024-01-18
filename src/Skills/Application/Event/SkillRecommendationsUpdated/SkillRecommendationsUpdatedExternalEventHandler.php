<?php

declare(strict_types=1);

namespace App\Skills\Application\Event\SkillRecommendationsUpdated;

use App\Shared\Application\Event\EventHandlerInterface;
use App\Skills\Domain\Aggregate\RecommendedSkill\RecommendedSkill;
use App\Skills\Domain\Aggregate\RecommendedSkill\RecommendedSkillRepositoryInterface;

final readonly class SkillRecommendationsUpdatedExternalEventHandler implements EventHandlerInterface
{
    public function __construct(private RecommendedSkillRepositoryInterface $recommendedSkillRepository)
    {
    }

    public function __invoke(SkillRecommendationsUpdatedExternalEvent $event): void
    {
        $skillRecommendations = array_map(
            static fn (array $data) => new RecommendedSkill($data['skillId'], $data['score']),
            $event->skillRecommendations
        );
        $this->recommendedSkillRepository->saveUserRecommendations($event->userId, $skillRecommendations);
    }
}
