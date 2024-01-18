<?php

declare(strict_types=1);

namespace App\Users\Domain\Aggregate\User;

use App\Shared\Domain\Security\AuthUserInterface;
use App\Shared\Domain\Security\Role;
use App\Shared\Domain\Service\UlidService;
use App\Users\Domain\Aggregate\AggregateRoot;
use App\Users\Domain\Service\UserPasswordHasherInterface;
use Webmozart\Assert\Assert;

class User extends AggregateRoot implements AuthUserInterface
{
    private string $id;
    private string $email;
    private ?string $password = null;

    /**
     * @var array<string>
     */
    private array $roles = [];

    public function __construct(string $email, string $role)
    {
        $this->id = UlidService::generate();
        $this->email = $email;

        $this->addRole($role);
        // Пользователь всегда должен имеет роль ROLE_USER
        if (Role::ROLE_USER !== $role) {
            $this->addRole(Role::ROLE_USER);
        }

        $this->registerDomainEvent(new UserCreatedDomainEvent($this->id));
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function setPassword(
        ?string $password,
        UserPasswordHasherInterface $passwordHasher
    ): void {
        if (is_null($password)) {
            $this->password = null;
        }

        $this->password = $passwordHasher->hash($this, $password);
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function addRole(string $role): void
    {
        Assert::inArray($role, Role::ROLES, 'Неверная роль');
        if (!in_array($role, $this->roles)) {
            $this->roles[] = $role;
        }
    }
}
