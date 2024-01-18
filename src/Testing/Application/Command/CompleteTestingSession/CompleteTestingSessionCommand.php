<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CompleteTestingSession;

use App\Shared\Application\Command\Command;

final readonly class CompleteTestingSessionCommand extends Command
{
    public function __construct(public string $testingSessionId)
    {
    }
}
