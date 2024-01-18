<?php

declare(strict_types=1);

namespace App\Orders\Application\UseCase\Command\CreateMaterialPurchaseOrder;

use App\Orders\Application\Service\Material\MaterialApiInterface;
use App\Orders\Domain\Aggregate\Order\OrderRepositoryInterface;
use App\Orders\Domain\Factory\OrderFactory;
use App\Shared\Application\Command\CommandHandlerInterface;

final readonly class CreateMaterialPurchaseOrderCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private OrderFactory $orderFactory,
        private MaterialApiInterface $materialApi
    ) {
    }

    public function __invoke(CreateMaterialPurchaseOrderCommand $command): void
    {
        $material = $this->materialApi->findMaterial($command->materialId);
        $order = $this->orderFactory->createPurchaseOrderForPaidMaterial(
            $command->customerId,
            $material->id,
            $material->name,
            $material->price
        );

        $this->orderRepository->save($order);
    }
}
