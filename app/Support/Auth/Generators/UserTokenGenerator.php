<?php

declare(strict_types=1);

namespace App\Support\Auth\Generators;

use App\Base\Interfaces\Generators\GeneratorInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UserTokenGenerator implements GeneratorInterface
{
    public function generate(array $args): string
    {
        $user = Arr::get($args, 'user');
        $token = $user->createToken(Str::uuid()->toString());

        return $token->plainTextToken;
    }
}
