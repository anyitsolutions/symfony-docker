<?php

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Aggregate\SkillConfirmation\Level;
use App\Skills\Domain\Aggregate\SkillConfirmation\SkillConfirmation;
use App\Skills\Domain\Repository\SkillConfirmationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SkillConfirmationRepository extends ServiceEntityRepository implements SkillConfirmationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SkillConfirmation::class);
    }

    public function findByLevel(string $skillId, string $specialistId, Level $level): ?SkillConfirmation
    {
        return $this->findOneBy(['skill' => $skillId, 'specialist' => $specialistId, 'level' => $level]);
    }

    public function add(SkillConfirmation $skillConfirmation): void
    {
        $this->_em->persist($skillConfirmation);
        $this->_em->flush();
    }

    public function findActualByUser(string $userId, array $skillIds = []): array
    {
        // Нужно получить токлько последние подтверждения для каждого навыка, без группировки. Используя подзапросы
        $qb = $this->createQueryBuilder('sc');
        $parameters = [];

        $sbq = $this->createQueryBuilder('sc2')
            ->select('sc2.id')
            ->leftJoin('sc2.specialist', 'specialist');
        $sbq->andWhere('specialist.publicUserId = :userId');
        $parameters['userId'] = $userId;
        if ($skillIds) {
            $sbq->andWhere('sc2.skill IN (:skillIds)');
            $parameters['skillIds'] = $skillIds;
        }
        $sbq->groupBy('sc2.specialist, sc2.skill');
        $sbq->having('sc2.actualizedAt = MAX(sc2.actualizedAt)');

        $qb->where($qb->expr()->in('sc.id', $sbq->getDQL()))
            ->setParameters($parameters);

        return $qb->getQuery()->getResult();
    }

    public function getAllActual(): array
    {
        $qb = $this->createQueryBuilder('sc');
        $parameters = [];

        $sbq = $this->createQueryBuilder('sc2')
            ->select('sc2.id')
            ->leftJoin('sc2.specialist', 'specialist')
            ->groupBy('sc2.specialist, sc2.skill')
            ->having('sc2.actualizedAt = MAX(sc2.actualizedAt)');

        $qb->where($qb->expr()->in('sc.id', $sbq->getDQL()))
            ->setParameters($parameters);

        return $qb->getQuery()->getResult();
    }
}
