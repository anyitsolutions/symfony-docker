<?php

namespace App\Tests\Functional\Inventory\Application\UseCase;

use App\Inventory\Application\UseCase\Command\ReleaseReservedProducts\ReleaseReservedProductsCommand;
use App\Inventory\Domain\Aggregate\Product\ProductRepositoryInterface;
use App\Inventory\Domain\Aggregate\Product\ProductReservationRepositoryInterface;
use App\Shared\Application\Command\CommandBusInterface;
use App\Tests\Tools\DITools;
use App\Tests\Tools\FakerTools;
use App\Tests\Tools\FixtureTools;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReleaseReservedProductsCommandTest extends WebTestCase
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
        $productReservation = $this->loadProductReservationFixture();
        $product = $this->productRepository->findOne($productReservation->getProductId());
        $productQuantity = $product->getQuantity();
        $command = new ReleaseReservedProductsCommand($productReservation->getOrderId());

        // act
        $this->commandBus->execute($command);

        // assert
        $product = $this->productRepository->findOne($product->getId());
        $productReservations = $this->productReservationRepository->findByOrderId($productReservation->getOrderId());

        $this->assertCount(0, $productReservations);
        $this->assertEquals($productQuantity + $productReservation->getQuantity(), $product->getQuantity());
    }
}
