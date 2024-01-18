<?php

declare(strict_types=1);

namespace App\Skills\Domain\Aggregate\Skill;

use App\Shared\Domain\Service\UlidService;
use App\Skills\Domain\Aggregate\AggregateRoot;
use App\Skills\Domain\Aggregate\Skill\Specification\SkillGroupNameSpecification;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Группа навыков.
 */
class SkillGroup extends AggregateRoot
{
    private string $id;

    private string $name;
    private bool $hidden = true;

    private string $description = '';

    /**
     * @var Collection<Skill>
     */
    private Collection $skills;

    private SkillGroupNameSpecification $skillGroupNameSpecification;
    private string $ownerId;

    public function __construct(
        string $name,
        string $ownerId,
        SkillGroupNameSpecification $skillGroupNameSpecification
    ) {
        $this->skillGroupNameSpecification = $skillGroupNameSpecification;
        $this->id = UlidService::generate();
        $this->skills = new ArrayCollection();
        $this->setName($name);
        $this->ownerId = $ownerId;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->skillGroupNameSpecification->satisfy($this);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Collection<Skill>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function getOwnerId(): string
    {
        return $this->ownerId;
    }
}
