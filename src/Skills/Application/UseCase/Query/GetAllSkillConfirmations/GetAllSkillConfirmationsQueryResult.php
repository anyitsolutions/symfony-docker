<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\GetAllSkillConfirmations;

final readonly class GetAllSkillConfirmationsQueryResult
{
    public function __construct(public array $skillConfirmations)
    {
    }
}
