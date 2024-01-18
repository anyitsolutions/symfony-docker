<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\GetUserSkillConfirmations;

use App\Skills\Application\DTO\SkillComposite\SkillConfirmationDTO;
use App\Skills\Domain\Repository\SkillConfirmationRepositoryInterface;

final class GetUserSkillConfirmationsQueryHandler
{
    public function __construct(
        private SkillConfirmationRepositoryInterface $skillConfirmationRepository,
    ) {
    }

    public function __invoke(GetUserSkillConfirmationsQuery $query): GetUserSkillConfirmationsQueryResult
    {
        $skillConfirmations = $this->skillConfirmationRepository->findActualByUser($query->userId);

        $skillConfirmationsDTO = [];
        foreach ($skillConfirmations as $skillConfirmation) {
            $skillConfirmationsDTO[] = SkillConfirmationDTO::fromEntity($skillConfirmation);
        }

        return new GetUserSkillConfirmationsQueryResult($skillConfirmationsDTO);
    }
}
