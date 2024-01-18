<?php

declare(strict_types=1);

namespace App\Skills\Domain\Repository;

use App\Shared\Domain\Repository\Pager;

readonly class SkillGroupsFilter
{
    public function __construct(
        public ?string $name = null,
        public ?Pager $pager = null,
    ) {
    }
}
