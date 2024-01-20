<?php

declare(strict_types=1);

namespace App\Orders\Infrastructure\Event\Outbox;

use App\Orders\Domain\Aggregate\DomainEventInterface;
use App\Shared\Domain\Service\UlidService;

final class OutboxMessage
{
    private string $id;
    private DomainEventInterface $message;

    public function __construct(DomainEventInterface $message)
    {
        $this->id = UlidService::generate();
        $this->message = $message;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMessage(): DomainEventInterface
    {
        return $this->message;
    }
}
