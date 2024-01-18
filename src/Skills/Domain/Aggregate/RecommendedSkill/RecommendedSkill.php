<?php

declare(strict_types=1);

namespace App\Skills\Domain\Aggregate\RecommendedSkill;

/**
 * Навык, рекомендованный пользователю.
 */
final readonly class RecommendedSkill
{
    public function __construct(
        public string $skillId,
        public float $score,
    ) {
    }
}
