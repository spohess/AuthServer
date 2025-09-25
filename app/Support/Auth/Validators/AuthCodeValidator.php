<?php

namespace App\Support\Auth\Validators;

use App\Base\Interfaces\Validators\ValidatorInterface;
use App\Support\Auth\Actions\AuthCode\AuthCodeFinderAction;
use App\Support\Auth\Exceptions\InvalidCodeException;
use App\Support\Auth\Models\AuthCode;
use Illuminate\Support\Arr;

class AuthCodeValidator implements ValidatorInterface
{
    public function __construct(
        private AuthCodeFinderAction $authCodeFinder,
    ) {}

    public function validate($subject): void
    {
        /**
         * @var AuthCode $authCode
         */
        $authCode = $this->authCodeFinder->find([
            'code' => Arr::get($subject, 'code'),
            'email' => Arr::get($subject, 'email'),
        ]);

        throw_if(!$authCode, InvalidCodeException::class);

        throw_if($authCode->expires_at->isPast(), InvalidCodeException::class);
    }
}
