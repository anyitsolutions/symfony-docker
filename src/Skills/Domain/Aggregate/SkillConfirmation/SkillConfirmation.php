<?php

declare(strict_types=1);

namespace App\Skills\Domain\Aggregate\SkillConfirmation;

use App\Shared\Domain\Service\UlidService;
use App\Skills\Domain\Aggregate\Skill\Skill;
use App\Skills\Domain\Aggregate\Specialist\Specialist;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Подтверждение навыка.
 */
class SkillConfirmation
{
    private string $id;

    private Specialist $specialist;

    private Skill $skill;

    /**
     * @var Collection<Proof>
     */
    private Collection $proofs;

    private Level $level = Level::DONT_KNOW;

    private \DateTimeImmutable $createdAt;

    private ?\DateTimeImmutable $actualizedAt = null;

    public function __construct(Specialist $specialist, Skill $skill, Level $level)
    {
        $this->id = UlidService::generate();
        $this->specialist = $specialist;
        $this->skill = $skill;
        $this->proofs = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->level = $level;
    }

    public function addProof(Proof $proof): void
    {
        // Не добавляем док-во подтверждения, если док-во с таким же тестом было добавлено ранее
        foreach ($this->proofs as $exProof) {
            if ($exProof->getTestId() === $proof->getTestId()) {
                break;
            }
        }

        $this->proofs->add($proof);
    }

    /**
     * @return Collection<Proof>
     */
    public function getProofs(): Collection
    {
        return $this->proofs;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSpecialist(): Specialist
    {
        return $this->specialist;
    }

    public function getSkill(): Skill
    {
        return $this->skill;
    }

    public function getLevel(): Level
    {
        return $this->level;
    }

    public function setLevel(Level $level): void
    {
        $this->level = $level;
    }

    public function actual(): void
    {
        $this->actualizedAt = new \DateTimeImmutable();
    }
}
