<?php

declare(strict_types=1);

namespace App\Training\Infrastructure\EventHandler;

use App\Training\Domain\Aggregate\Material\MaterialCreatedDomainEvent;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class MaterialCreatedEventHandler
{
    public function __invoke(MaterialCreatedDomainEvent $event): void
    {
        $file = fopen('material_created.txt', 'a');
        fwrite($file, $event->materialId.PHP_EOL);
        fclose($file);

        echo 'Material created event handled'.PHP_EOL;
    }
}
