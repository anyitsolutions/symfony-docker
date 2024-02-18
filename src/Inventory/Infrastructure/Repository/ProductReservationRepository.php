<?php

declare(strict_types=1);

namespace App\Inventory\Infrastructure\Repository;

use App\Inventory\Domain\Aggregate\Product\ProductReservation;
use App\Inventory\Domain\Aggregate\Product\ProductReservationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ProductReservationRepository extends ServiceEntityRepository implements ProductReservationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductReservation::class);
    }

    public function saveBatch(array $entities): void
    {
        foreach ($entities as $entity) {
            $this->_em->persist($entity);
        }

        $this->_em->flush();
    }

    public function findByOrderId(string $orderId): array
    {
        return $this->findBy(['orderId' => $orderId]);
    }

    public function removeBatch(array $productReservations): void
    {
        foreach ($productReservations as $productReservation) {
            $this->_em->remove($productReservation);
        }

        $this->_em->flush();
    }
}
