<?php

namespace App\Support\Auth\Validators;

use App\Base\Interfaces\Validators\ValidatorInterface;
use App\Support\Auth\Actions\AuthCode\AuthCodeFinderAction;
use Illuminate\Support\Arr;

class AuthCodeValidator implements ValidatorInterface
{
    public function __construct(
        private AuthCodeFinderAction $authCodeFinder,
    ) {}

    public function validate($subject): void
    {
        $authCode = $this->authCodeFinder->find([
            'code' => Arr::get($subject, 'code'),
            'email' => Arr::get($subject, 'email'),
        ]);
    }
}
