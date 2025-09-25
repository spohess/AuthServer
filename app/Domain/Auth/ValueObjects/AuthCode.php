<?php

declare(strict_types=1);

namespace App\Domain\Auth\ValueObjects;

use App\Base\Exceptions\CodeGeneratorException;
use App\Base\Exceptions\InvalidAttemptException;
use App\Base\Interfaces\ValueObjectInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Random\RandomException;

class AuthCode implements ValueObjectInterface, Arrayable
{
    public readonly int $code;

    /**
     * @throws CodeGeneratorException
     * @throws InvalidAttemptException
     */
    public function __construct(
        public readonly string $email,
        private ?Carbon $expiresAt = null,
        private ?int $attempts = null,
        public readonly ?int $codeLength = 6,
        public readonly ?int $codeLifetime = 30,
        public readonly ?int $maxAttempts = 5,
    ) {
        $this->expiresAt ??= Carbon::now()->addMinutes($this->codeLifetime);
        $this->attempts = is_null($this->attempts) ? 1 : $this->attempts + 1;
        $this->code = $this->generateCode();
    }

    /**
     * @throws CodeGeneratorException
     * @throws InvalidAttemptException
     */
    private function generateCode(): int
    {
        $this->canGenerateCode();

        $min = 10 ** ($this->codeLength - 1);
        $max = (10 ** $this->codeLength) - 1;

        try {
            return random_int($min, $max);
        } catch (RandomException) {
            throw new CodeGeneratorException();
        }
    }

    /**
     * @throws InvalidAttemptException
     */
    private function canGenerateCode(): void
    {
        if ($this->attempts <= $this->maxAttempts) {
            $this->expiresAt = Carbon::now()->addMinutes($this->codeLifetime);
            return;
        }

        if ($this->expiresAt->isPast()) {
            $this->expiresAt = Carbon::now()->addMinutes($this->codeLifetime);
            $this->attempts = 1;
            return;
        }

        throw new InvalidAttemptException();
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'code' => $this->code,
            'expires_at' => $this->expiresAt,
            'attempts' => $this->attempts,
        ];
    }
}
