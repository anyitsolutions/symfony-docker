<?php

declare(strict_types=1);

namespace App\Skills\Domain\Service;

use App\Skills\Domain\Aggregate\Specialist\Specialist;
use App\Skills\Domain\Factory\SpecialistFactory;
use App\Skills\Domain\Repository\SpecialistRepositoryInterface;

final class SpecialistMaker
{
    public function __construct(private SpecialistFactory $specialistFactory, private SpecialistRepositoryInterface $specialistRepository)
    {
    }

    public function make(string $publicUserId): Specialist
    {
        $specialist = $this->specialistRepository->findOneByPublicUserId($publicUserId);
        if (!$specialist) {
            $specialist = $this->specialistFactory->create($publicUserId);
            $this->specialistRepository->add($specialist);
        }

        return $specialist;
    }
}
