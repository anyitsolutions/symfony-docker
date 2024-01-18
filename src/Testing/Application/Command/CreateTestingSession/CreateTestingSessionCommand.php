<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateTestingSession;

use App\Shared\Application\Command\Command;

final readonly class CreateTestingSessionCommand extends Command
{
    public function __construct(
        public string $testId,
        public string $userId,
    ) {
    }
}
