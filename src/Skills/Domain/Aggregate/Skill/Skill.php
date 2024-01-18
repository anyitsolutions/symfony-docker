<?php

declare(strict_types=1);

namespace App\Skills\Domain\Aggregate\Skill;

use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Service\UlidService;
use App\Skills\Domain\Aggregate\AggregateRoot;
use App\Skills\Domain\Aggregate\Skill\Specification\SkillSpecification;

/**
 * Навык.
 */
class Skill extends AggregateRoot
{
    /**
     * Минимальная длина названия навыка.
     */
    public const NAME_MIN_LENGTH = 2;

    /**
     * Максимальная длина названия навыка.
     */
    public const NAME_MAX_LENGTH = 100;

    private string $id;

    private string $name;

    private string $description = '';

    private SkillGroup $skillGroup;

    private SkillSpecification $skillSpecification;

    private string $ownerId;

    public function __construct(
        string $name,
        SkillGroup $skillGroup,
        string $ownerId,
        SkillSpecification $skillSpecification
    ) {
        $this->skillSpecification = $skillSpecification;
        $this->id = UlidService::generate();

        $this->setNameAndGroup($name, $skillGroup);
        $this->ownerId = $ownerId;
    }

    public function setNameAndGroup(string $name, SkillGroup $skillGroup): void
    {
        AssertService::lengthBetween(
            $name,
            self::NAME_MIN_LENGTH,
            self::NAME_MAX_LENGTH,
            sprintf('Название навыка должно быть не менее 3 и не более 100 символов. %s', $name)
        );

        $this->name = $name;
        $this->skillGroup = $skillGroup;

        $this->skillSpecification
            ->uniqueSkillInGroupSpecification
            ->satisfy($this);
    }

    public function getSkillGroup(): SkillGroup
    {
        return $this->skillGroup;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function isOwnedBy(string $skillId): bool
    {
        return $this->ownerId === $skillId;
    }
}
