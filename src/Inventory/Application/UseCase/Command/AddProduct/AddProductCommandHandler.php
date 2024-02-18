<?php

declare(strict_types=1);

namespace App\Inventory\Application\UseCase\Command\AddProduct;

use App\Inventory\Domain\Service\ProductService;
use App\Shared\Application\Command\CommandHandlerInterface;

final class AddProductCommandHandler implements CommandHandlerInterface
{
    public function __construct(private ProductService $productService)
    {
    }

    public function __invoke(AddProductCommand $command): void
    {
        $this->productService->add($command->productId, $command->quantity);
    }
}
