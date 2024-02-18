<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\Entity;

use App\Saga\CreateOrder\Repository\CreateOrderSagaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Хранит информацию о саге и ее состоянии.
 */
#[ORM\Entity(repositoryClass: CreateOrderSagaRepository::class)]
#[ORM\Table(name: 'saga_create_order')]
final class CreateOrderSagaEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private string $id;

    #[ORM\Column]
    private string $orderId;

    #[ORM\Column(type: 'string', enumType: State::class)]
    private State $state;

    #[ORM\Column(type: 'text')]
    private string $payload;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct(string $orderId, State $state, string $payload = '')
    {
        $this->orderId = $orderId;
        $this->state = $state;
        $this->payload = $payload;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): CreateOrderSagaEntity
    {
        $this->id = $id;

        return $this;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): CreateOrderSagaEntity
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getPayload(): string
    {
        return $this->payload;
    }

    public function setPayload(string $payload): CreateOrderSagaEntity
    {
        $this->payload = $payload;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): CreateOrderSagaEntity
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getState(): State
    {
        return $this->state;
    }

    public function setState(State $state): void
    {
        $this->state = $state;
    }
}
