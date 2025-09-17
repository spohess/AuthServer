<?php

declare(strict_types=1);

namespace App\Domain\Auth\ValueObjects;

use App\Base\Exceptions\CodeGeneretorException;
use App\Base\Exceptions\InvalidAttemptException;
use App\Base\Interfaces\ValueObjectInterface;
use Carbon\Carbon;
use Random\RandomException;

class AuthCode implements ValueObjectInterface
{
    public readonly int $code;

    /**
     * @throws CodeGeneretorException
     * @throws InvalidAttemptException
     */
    public function __construct(
        public readonly string $userId,
        public readonly ?Carbon $expiresAt = new Carbon(),
        public readonly ?int $attempts = 0,
        public readonly ?int $codeLength = 6,
        public readonly ?int $codeLifetime = 30,
        public readonly ?int $maxAttempts = 5,
    ) {
        $this->code = $this->generateCode();
    }

    /**
     * @throws CodeGeneretorException
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
            throw new CodeGeneretorException();
        }
    }

    /**
     * @throws InvalidAttemptException
     */
    private function canGenerateCode(): void
    {
        if ($this->attempts < $this->maxAttempts) {
            return;
        }

        if ($this->expiresAt->isPast()) {
            return;
        }

        throw new InvalidAttemptException();
    }
}
