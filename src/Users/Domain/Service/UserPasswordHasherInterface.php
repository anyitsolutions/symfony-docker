<?php

declare(strict_types=1);

namespace App\Users\Domain\Service;

use App\Users\Domain\Aggregate\User\User;

interface UserPasswordHasherInterface
{
    public function hash(User $user, string $password): string;
}
