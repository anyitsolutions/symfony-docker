<?php

declare(strict_types=1);

namespace App\Saga\CreateOrder;

use App\Saga\CreateOrder\Entity\CreateOrderSagaEntity;
use App\Saga\CreateOrder\Entity\State;
use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\MarkingStore\MarkingStoreInterface;

final class SagaMarkingStore implements MarkingStoreInterface
{
    public function getMarking(object $subject): Marking
    {
        return new Marking([$subject->getState()->value => 1]);
    }

    /**
     * @param object|CreateOrderSagaEntity $subject
     */
    public function setMarking(object $subject, Marking $marking, array $context = []): void
    {
        $marking = key($marking->getPlaces());
        $subject->setState(State::from($marking));
    }
}
