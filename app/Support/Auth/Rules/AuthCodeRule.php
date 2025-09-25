<?php

namespace App\Support\Auth\Rules;

use App\Support\Auth\Exceptions\InvalidCodeException;
use App\Support\Auth\Validators\AuthCodeValidator;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AuthCodeRule implements ValidationRule
{
    public function __construct(
        private string $email,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $enable = config('auth.code.enable');
        if ($enable === false) {
            return;
        }

        if (!is_int($value)) {
            $fail('The code must be an integer.');

            return;
        }

        $validator = app()->make(AuthCodeValidator::class);
        try {
            $validator->validate([
                'code' => $value,
                'email' => $this->email,
            ]);
        } catch (InvalidCodeException $e) {
            $fail($e->getMessage());
        }
    }
}
