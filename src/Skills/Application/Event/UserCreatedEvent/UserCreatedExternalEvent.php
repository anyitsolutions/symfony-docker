<?php

declare(strict_types=1);

namespace App\Skills\Application\Event\UserCreatedEvent;

final class UserCreatedExternalEvent
{
    public function __construct(public string $userId)
    {
    }
}
