<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repository;

/**
 * @template T
 */
readonly class PaginationResult
{
    /**
     * @param T[] $items
     */
    public function __construct(public array $items, public Pager $pager)
    {
    }
}
