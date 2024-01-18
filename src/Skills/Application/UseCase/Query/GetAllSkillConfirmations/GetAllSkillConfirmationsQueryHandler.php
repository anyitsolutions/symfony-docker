<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\GetAllSkillConfirmations;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\DTO\SkillComposite\SkillConfirmationDTO;
use App\Skills\Domain\Repository\SkillConfirmationRepositoryInterface;

final readonly class GetAllSkillConfirmationsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private SkillConfirmationRepositoryInterface $skillConfirmationRepository,
    ) {
    }

    public function __invoke(GetAllSkillConfirmationsQuery $query): GetAllSkillConfirmationsQueryResult
    {
        $skillConfirmations = $this->skillConfirmationRepository->getAllActual();

        $skillConfirmationsDTO = [];
        foreach ($skillConfirmations as $skillConfirmation) {
            $skillConfirmationsDTO[] = SkillConfirmationDTO::fromEntity($skillConfirmation);
        }

        return new GetAllSkillConfirmationsQueryResult($skillConfirmationsDTO);
    }
}
