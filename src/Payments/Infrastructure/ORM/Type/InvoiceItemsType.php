<?php

declare(strict_types=1);

namespace App\Payments\Infrastructure\ORM\Type;

use App\Payments\Domain\Aggregate\Invoice\Item;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class InvoiceItemsType extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'json NOT NULL';
    }

    public function getName(): string
    {
        return 'invoice_items';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        $serializer = new Serializer([new ArrayDenormalizer(), new ObjectNormalizer()], [new JsonEncoder()]);

        return $serializer->deserialize($value, Item::class.'[]', 'json');
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        $serializer = new Serializer([new ArrayDenormalizer(), new ObjectNormalizer()], [new JsonEncoder()]);

        return $serializer->serialize($value, 'json');
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
