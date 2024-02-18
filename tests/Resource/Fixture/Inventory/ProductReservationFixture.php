<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture\Inventory;

use App\Inventory\Domain\Aggregate\Product\Product;
use App\Inventory\Domain\Factory\ProductReservationFactory;
use App\Shared\Domain\Service\UlidService;
use App\Tests\Tools\FakerTools;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ProductReservationFixture extends Fixture implements DependentFixtureInterface
{
    use FakerTools;

    public const REFERENCE = 'product_reservation';

    public function __construct(
        private readonly ProductReservationFactory $productReservationFactory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $orderId = UlidService::generate();
        /**
         * @var Product $product
         */
        $product = $this->getReference(ProductFixture::REFERENCE);
        $productReservation = $this->productReservationFactory->create($product->getId(), $orderId, 1);

        $manager->persist($productReservation);
        $manager->flush();

        $this->addReference(self::REFERENCE, $productReservation);
    }

    public function getDependencies()
    {
        return [
            ProductFixture::class,
        ];
    }
}
