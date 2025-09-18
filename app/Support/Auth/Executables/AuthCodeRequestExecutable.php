<?php

declare(strict_types=1);

namespace App\Support\Auth\Executables;

use App\Base\Interfaces\Services\ExecutableInterface;
use App\Support\Auth\Models\User;

class AuthCodeRequestExecutable implements ExecutableInterface
{
    public function __construct(
        private User $user,
    ) {}

    public function handler(): array
    {
        return [
            'user' => $this->user,
        ];
    }
}
