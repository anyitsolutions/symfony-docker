<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\GetPagedSkills;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\DTO\Skill\SkillDTO;
use App\Skills\Application\DTO\SkillComposite\SkillCompositeDTO;
use App\Skills\Application\DTO\SkillComposite\SkillConfirmationDTO;
use App\Skills\Application\DTO\SkillComposite\SkillRecommendationDTO;
use App\Skills\Domain\Aggregate\RecommendedSkill\RecommendedSkillRepositoryInterface;
use App\Skills\Domain\Repository\SkillConfirmationRepositoryInterface;
use App\Skills\Domain\Repository\SkillRepositoryInterface;

readonly class GetPagedSkillsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private SkillRepositoryInterface $skillRepository,
        private RecommendedSkillRepositoryInterface $recommendedSkillRepository,
        private SkillConfirmationRepositoryInterface $skillConfirmationRepository
    ) {
    }

    public function __invoke(GetPagedSkillsQuery $query): GetPagedSkillsQueryResult
    {
        $userId = $query->filter->userId;

        $recommendedSkillsMap = $userId ? $this->getRecommendedSkills($userId) : [];
        $skillConfirmationsMap = $userId ? $this->getSkillConfirmationDTOS($userId) : [];

        // Add recommended skills to filter
        if ($query->filter->recommended && $recommendedSkillsMap) {
            $query->filter->includedSkillIds = array_merge(
                array_keys($recommendedSkillsMap),
                $query->filter->includedSkillIds ?? []
            );
        }

        // Find paginated skills
        /** @var array<string, SkillDTO> $skills */
        $skills = [];
        $paginator = $this->skillRepository->findByFilter($query->filter);
        foreach ($paginator->items as $skill) {
            $skills[$skill->getId()] = SkillDTO::fromEntity($skill);
        }

        // Create SkillCompositeDTOs from skills, skill confirmations and recommended skills
        /** @var array<SkillCompositeDTO> $skillCompositeDTOList */
        $skillCompositeDTOList = [];
        foreach ($skills as $skill) {
            $skillCompositeDTOList[] = new SkillCompositeDTO(
                $skill,
                $skillConfirmationsMap[$skill->id] ?? null,
                $recommendedSkillsMap[$skill->id] ?? null
            );
        }

        return new GetPagedSkillsQueryResult($skillCompositeDTOList, $paginator->pager);
    }

    /**
     * @return array<string, SkillRecommendationDTO>
     */
    private function getRecommendedSkills(string $userId): array
    {
        $recommendedSkills = [];
        $entities = $this->recommendedSkillRepository->getRecommendedSkills($userId);
        foreach ($entities as $recommendedSkill) {
            $recommendedSkills[$recommendedSkill->skillId] = new SkillRecommendationDTO(
                $recommendedSkill->skillId,
                $recommendedSkill->score
            );
        }

        return $recommendedSkills;
    }

    /**
     * @return array<string, SkillConfirmationDTO>
     */
    private function getSkillConfirmationDTOS(string $userId): array
    {
        $skillConfirmations = [];
        $entities = $this->skillConfirmationRepository->findActualByUser($userId);
        foreach ($entities as $skillConfirmation) {
            $skillConfirmations[$skillConfirmation->getSkill()->getId()] = new SkillConfirmationDTO(
                $skillConfirmation->getId(),
                $skillConfirmation->getSpecialist()->getId(),
                $skillConfirmation->getSkill()->getId(),
                $skillConfirmation->getLevel()->value
            );
        }

        return $skillConfirmations;
    }
}
