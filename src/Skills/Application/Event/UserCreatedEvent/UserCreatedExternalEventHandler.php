<?php

declare(strict_types=1);

namespace App\Skills\Application\Event\UserCreatedEvent;

use App\Shared\Application\Event\EventHandlerInterface;
use App\Skills\Domain\Service\SpecialistMaker;

final class UserCreatedExternalEventHandler implements EventHandlerInterface
{
    public function __construct(private SpecialistMaker $specialistMaker)
    {
    }

    public function __invoke(UserCreatedExternalEvent $event)
    {
        $this->specialistMaker->make($event->userId);
    }
}
