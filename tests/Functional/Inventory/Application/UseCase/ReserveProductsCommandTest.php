<?php

namespace App\Tests\Functional\Inventory\Application\UseCase;

use App\Inventory\Application\UseCase\Command\ReserveProducts\ReserveProductsCommand;
use App\Inventory\Domain\Aggregate\Product\ProductRepositoryInterface;
use App\Inventory\Domain\Aggregate\Product\ProductReservationRepositoryInterface;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Domain\Service\UlidService;
use App\Tests\Tools\DITools;
use App\Tests\Tools\FakerTools;
use App\Tests\Tools\FixtureTools;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReserveProductsCommandTest extends WebTestCase
{
    use FakerTools;
    use DITools;
    use FixtureTools;

    private ProductRepositoryInterface $productRepository;
    private CommandBusInterface $commandBus;
    private ProductReservationRepositoryInterface $productReservationRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->commandBus = $this->getService(CommandBusInterface::class);
        $this->productReservationRepository = $this->getService(ProductReservationRepositoryInterface::class);
        $this->productRepository = $this->getService(ProductRepositoryInterface::class);
    }

    public function test_it_should_reserve_products(): void
    {
        $product = $this->loadProductFixture();
        $productQuantity = $product->getQuantity();
        $orderId = UlidService::generate();
        $productIds = [$product->getId()];
        $command = new ReserveProductsCommand($productIds, $orderId);

        // act
        $this->commandBus->execute($command);

        // assert
        $product = $this->productRepository->findOne($product->getId());
        $productReservations = $this->productReservationRepository->findByOrderId($orderId);

        $this->assertCount(1, $productReservations);
        $this->assertEquals($product->getId(), $productReservations[0]->getProductId());
        $this->assertEquals($productReservations[0]->getQuantity(), 1);
        $this->assertEquals($productQuantity - 1, $product->getQuantity());
    }
}
