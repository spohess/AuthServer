<?php

declare(strict_types=1);

namespace App\Support\Auth\Executables;

use App\Base\Interfaces\Services\ExecutableInterface;
use App\Support\Auth\Actions\AuthCode\AuthCodeCreatorAction;
use App\Support\Auth\Actions\AuthCode\AuthCodeFinderAction;
use App\Support\Auth\Generators\CodeGenerator;
use App\Support\Auth\Models\User;

class AuthCodeRequestExecutable implements ExecutableInterface
{
    public function __construct(
        private User $user,
        private CodeGenerator $generator,
        private AuthCodeFinderAction $finder,
        private AuthCodeCreatorAction $codeCreator,
    ) {}

    public function handler(): array
    {
        $authCode = $this->finder->find(['user_id' => $this->user->id]);
        if ($authCode) {
        }

        return [
            'user' => $this->user,
            'auth_code_data' => [
                'user_id' => $this->user->id,
                'code' => $this->generator->generate([]),
                'expires_at' => now()->addMinutes(30),
                'attempts' => $authCode?->attempts ?? 0,
            ],
        ];
    }
}
