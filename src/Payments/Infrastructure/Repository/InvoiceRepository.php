<?php

declare(strict_types=1);

namespace App\Payments\Infrastructure\Repository;

use App\Payments\Domain\Aggregate\Invoice\Invoice;
use App\Payments\Domain\Aggregate\Invoice\InvoiceRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class InvoiceRepository extends ServiceEntityRepository implements InvoiceRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invoice::class);
    }

    public function save(Invoice $invoice): void
    {
        $this->_em->persist($invoice);
        $this->_em->flush();
    }

    public function findOne(string $invoiceId): ?Invoice
    {
        return $this->find($invoiceId);
    }

    public function findOneByOrderId(string $orderId): ?Invoice
    {
        return $this->findOneBy(['orderId' => $orderId]);
    }
}
