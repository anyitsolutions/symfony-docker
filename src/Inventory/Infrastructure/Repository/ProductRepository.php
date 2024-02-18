<?php

declare(strict_types=1);

namespace App\Inventory\Infrastructure\Repository;

use App\Inventory\Domain\Aggregate\Product\Product;
use App\Inventory\Domain\Aggregate\Product\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findOne(string $id): ?Product
    {
        return $this->find($id);
    }

    public function save(Product $product): void
    {
        $this->_em->persist($product);
        $this->_em->flush();
    }

    public function findProducts(array $ids): array
    {
        return $this->findBy(['id' => $ids]);
    }

    public function saveBatch(array $products): void
    {
        foreach ($products as $product) {
            $this->_em->persist($product);
        }

        $this->_em->flush();
    }
}
