<?php

declare(strict_types=1);

namespace App\Training\Infrastructure\Repository;

use App\Training\Domain\Aggregate\Material\Material;
use App\Training\Domain\Aggregate\Material\MaterialRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class MaterialRepository extends ServiceEntityRepository implements MaterialRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Material::class);
    }

    public function add(Material $material): void
    {
        $this->_em->persist($material);
        $this->_em->flush();
    }

    public function findOneById(string $materialId): ?Material
    {
        return $this->find($materialId);
    }
}
