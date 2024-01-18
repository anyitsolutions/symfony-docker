<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\GetUserSkillConfirmations;

use App\Shared\Application\Query\QueryInterface;

final class GetUserSkillConfirmationsQuery implements QueryInterface
{
    public function __construct(public string $userId)
    {
    }
}
