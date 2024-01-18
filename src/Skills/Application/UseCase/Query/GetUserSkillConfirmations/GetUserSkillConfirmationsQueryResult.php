<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\GetUserSkillConfirmations;

final readonly class GetUserSkillConfirmationsQueryResult
{
    public function __construct(public array $skillConfirmations)
    {
    }
}
