<?php

declare(strict_types=1);

namespace App\Inventory\Domain\Service;

use App\Inventory\Domain\Aggregate\Product\ProductRepositoryInterface;
use App\Inventory\Domain\Aggregate\Product\ProductReservationRejectedDomainEvent;
use App\Inventory\Domain\Aggregate\Product\ProductReservationRepositoryInterface;
use App\Inventory\Domain\Aggregate\Product\ProductsReservationReleasedDomainEvent;
use App\Inventory\Domain\Aggregate\Product\ProductsReservedDomainEvent;
use App\Inventory\Domain\Factory\ProductReservationFactory;
use Webmozart\Assert\Assert;

final class InventoryService
{
    public function __construct(
        private DomainEventPublisherInterface $domainEventPublisher,
        private ProductRepositoryInterface $productRepository,
        private ProductReservationFactory $productReservationFactory,
        private ProductReservationRepositoryInterface $productReservationRepository
    ) {
    }

    /**
     * Reserve products for an order.
     *
     * @param array<string> $productsIds
     */
    public function reserve(array $productsIds, string $orderId): void
    {
        $products = $this->productRepository->findProducts($productsIds);

        try {
            Assert::count($products, count($productsIds), 'Some products were not found');

            $productReservations = [];
            foreach ($products as $product) {
                $product->reserve(1);
                $productReservations[] = $this->productReservationFactory->create($product->getId(), $orderId, 1);
            }
        } catch (\Exception $e) {
            $this->domainEventPublisher->publish(
                new ProductReservationRejectedDomainEvent($productsIds, $orderId)
            );

            return;
        }

        $this->productReservationRepository->saveBatch($productReservations);
        $this->productRepository->saveBatch($products);

        $this->domainEventPublisher->publish(
            new ProductsReservedDomainEvent($productsIds, $orderId)
        );
    }

    /**
     * Release products from an order.
     */
    public function release(string $orderId): void
    {
        $productReservations = $this->productReservationRepository->findByOrderId($orderId);
        $products = [];
        foreach ($productReservations as $productReservation) {
            $product = $this->productRepository->findOne($productReservation->getProductId());
            $product->release($productReservation->getQuantity());
            $products[] = $product;
        }

        $this->productReservationRepository->removeBatch($productReservations);
        $this->productRepository->saveBatch($products);

        $productIds = array_map(fn ($productReservation) => $productReservation->getProductId(), $productReservations);
        $this->domainEventPublisher->publish(
            new ProductsReservationReleasedDomainEvent($productIds, $orderId)
        );
    }
}
