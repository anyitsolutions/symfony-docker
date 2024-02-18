<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder\Repository;

use App\Saga\CreateOrder\Entity\CreateOrderSagaEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class CreateOrderSagaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreateOrderSagaEntity::class);
    }

    public function save(CreateOrderSagaEntity $saga): void
    {
        $this->_em->persist($saga);
        $this->_em->flush();
    }

    public function findLastState(string $orderId): ?CreateOrderSagaEntity
    {
        return $this->createQueryBuilder('s')
            ->where('s.orderId = :orderId')
            ->setParameter('orderId', $orderId)
            ->orderBy('s.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
