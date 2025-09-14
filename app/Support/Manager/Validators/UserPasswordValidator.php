<?php

declare(strict_types=1);

namespace App\Support\Manager\Validators;

use App\Base\Interfaces\Validators\ValidatorInterface;
use App\Support\Manager\Exceptions\InvalidUserException;
use App\Support\Manager\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserPasswordValidator implements ValidatorInterface
{
    public function validate($subject): void
    {
        /**
         * @var User $user
         */
        $user = Arr::get($subject, 'user');
        throw_if(
            !$user,
            new InvalidUserException(),
        );

        throw_if(
            !Hash::check(Arr::get($subject, 'password'), $user->password),
            new InvalidUserException(),
        );
    }
}
