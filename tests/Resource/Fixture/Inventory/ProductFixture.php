<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture\Inventory;

use App\Inventory\Domain\Factory\ProductFactory;
use App\Shared\Domain\Service\UlidService;
use App\Tests\Tools\FakerTools;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class ProductFixture extends Fixture
{
    use FakerTools;

    public const REFERENCE = 'product';

    public function __construct(
        private readonly ProductFactory $productFactory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $productId = UlidService::generate();
        $product = $this->productFactory->create($productId, 10);

        $manager->persist($product);
        $manager->flush();

        $this->addReference(self::REFERENCE, $product);
    }
}
