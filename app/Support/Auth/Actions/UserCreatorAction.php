<?php

declare(strict_types=1);

namespace App\Support\Auth\Actions;

use App\Base\Interfaces\Actions\CreatorActionInterface;
use App\Support\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserCreatorAction implements CreatorActionInterface
{
    public function create(array $args): ?Model
    {
        return User::create([
            'uuid' => Str::uuid()->toString(),
            ...$args,
        ]);
    }
}
