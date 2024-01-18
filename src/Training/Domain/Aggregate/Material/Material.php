<?php

declare(strict_types=1);

namespace App\Training\Domain\Aggregate\Material;

use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Service\UlidService;
use App\Training\Domain\Aggregate\AggregateRoot;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Обучающий материал.
 */
final class Material extends AggregateRoot
{
    public const MAX_SKILLS_COUNT = 5;

    private string $id;
    private string $name;
    private string $description;
    private int $price = 0;
    private Type $type;

    private Collection $skills;

    private \DateTimeImmutable $createdAt;
    private ?\DateTimeImmutable $updatedAt;

    public function __construct(
        string $name,
        string $description,
        Type $type,
    ) {
        $this->id = UlidService::generate();
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->createdAt = new \DateTimeImmutable();
        $this->skills = new ArrayCollection();
        $this->registerDomainEvent(new MaterialCreatedDomainEvent($this->id));
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function addSkill(MaterialSkill $skill): void
    {
        AssertService::lessThan(
            $this->skills->count(),
            self::MAX_SKILLS_COUNT,
            sprintf('Обучающий материал не должен тренировать более %d навыков', self::MAX_SKILLS_COUNT)
        );
        $this->skills->add($skill);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}
