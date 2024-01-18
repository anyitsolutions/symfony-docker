<?php

declare(strict_types=1);

namespace App\Orders\Domain\Aggregate\Order;

use App\Orders\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Service\UlidService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Заказ.
 */
final class Order extends AggregateRoot
{
    private string $id;
    private string $customerId;
    private OrderStatus $status;
    private PaymentMethod $paymentMethod;

    /**
     * @var Collection<Item>
     */
    private Collection $items;

    private int $totalPrice;

    private \DateTimeImmutable $createdAt;
    private ?\DateTime $updatedAt = null;

    public function __construct(string $customerId, int $totalPrice, PaymentMethod $paymentMethod)
    {
        $this->id = UlidService::generate();
        $this->customerId = $customerId;
        $this->status = OrderStatus::CREATED;
        $this->items = new ArrayCollection();
        $this->totalPrice = $totalPrice;
        $this->paymentMethod = $paymentMethod;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function create(array $items): void
    {
        $this->items = new ArrayCollection($items);
        $this->status = OrderStatus::CREATED;

        $itemsEventData = $this->items->map(function (Item $item) {
            return [
                'id' => $item->getProduct()->getId(),
                'name' => $item->getProduct()->getName(),
                'price' => $item->getPrice(),
            ];
        })->toArray();
        $this->registerDomainEvent(new OrderCreatedEvent($this->id, $this->customerId, $itemsEventData, $this->totalPrice));
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }
}
