<?php

declare(strict_types=1);

namespace App\Skills\Application\DTO\SkillComposite;

use App\Skills\Domain\Aggregate\SkillConfirmation\SkillConfirmation;

final class SkillConfirmationDTO
{
    private string $id;
    private string $userId;
    private string $skillId;
    private string $level;

    public function __construct(string $id, string $userId, string $skillId, string $level)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->skillId = $skillId;
        $this->level = $level;
    }

    public static function fromEntity(SkillConfirmation $skillConfirmation): self
    {
        return new self(
            $skillConfirmation->getId(),
            $skillConfirmation->getSpecialist()->getPublicUserId(),
            $skillConfirmation->getSkill()->getId(),
            $skillConfirmation->getLevel()->value
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getSkillId(): string
    {
        return $this->skillId;
    }

    public function getLevel(): string
    {
        return $this->level;
    }
}
