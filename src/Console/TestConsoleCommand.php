<?php

declare(strict_types=1);

namespace App\Console;

use App\Inventory\Application\UseCase\InventoryUseCaseInteractor;
use App\Orders\Application\UseCase\OrdersUseCase;
use App\Orders\Domain\Aggregate\Order\OrderRepositoryInterface;
use App\Orders\Infrastructure\Adapter\Products\ProductsAdapter;
use App\Saga\CreateOrder\Service\Orchestrator\CreateOrderOrchestrator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'orders:test',
)]
final class TestConsoleCommand extends Command
{
    public function __construct(
        private OrdersUseCase $ordersUseCase,
        private ProductsAdapter $productsAdapter,
        private InventoryUseCaseInteractor $inventoryUseCaseInteractor,
        private OrderRepositoryInterface $orderRepository,
        private CreateOrderOrchestrator $createOrderOrchestratorSagaService,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->inventoryUseCaseInteractor->addProduct('product_id', 10);
        $product = $this->productsAdapter->findProduct('product_id');
        $orderId = $this->ordersUseCase
            ->createOrder('customer_id', $product->id)
            ->orderId;
        //        $this->createOrderOrchestratorSagaService->run($order->getId());

        return Command::SUCCESS;
    }
}
