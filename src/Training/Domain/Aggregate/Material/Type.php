<?php

declare(strict_types=1);

namespace App\Training\Domain\Aggregate\Material;

enum Type: string
{
    case VIDEO = 'video';
    case DOCUMENT = 'document';
}
