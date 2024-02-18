<?php

declare(strict_types=1);

namespace App\Payments\Infrastructure\Repository;

use App\Payments\Domain\Aggregate\Payment\Payment;
use App\Payments\Domain\Aggregate\Payment\PaymentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class PaymentRepository extends ServiceEntityRepository implements PaymentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payment::class);
    }

    public function save(Payment $payment): void
    {
        $this->_em->persist($payment);
        $this->_em->flush();
    }

    public function findOne(string $paymentId): ?Payment
    {
        return $this->find($paymentId);
    }

    public function findOneByExternalId(string $externalPaymentId): ?Payment
    {
        return $this->findOneBy(['externalPaymentId' => $externalPaymentId]);
    }
}
