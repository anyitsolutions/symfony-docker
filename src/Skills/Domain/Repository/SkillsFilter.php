<?php

declare(strict_types=1);

namespace App\Skills\Domain\Repository;

use App\Shared\Domain\Repository\Pager;

class SkillsFilter
{
    /**
     * @var string[]|null
     */
    public ?array $includedSkillIds = null;

    public function __construct(
        readonly public ?Pager $pager = null,
        readonly public ?string $userId = null,
        readonly public ?string $name = null,
        readonly public ?bool $recommended = null,
    ) {
    }
}
