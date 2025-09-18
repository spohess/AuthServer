<?php

declare(strict_types=1);

namespace App\Support\Auth\Actions\AuthCode;

use App\Base\Interfaces\Actions\CreatorActionInterface;
use App\Support\Auth\Models\AuthCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AuthCodeCreatorAction implements CreatorActionInterface
{
    public function create(array $args): ?Model
    {
        return AuthCode::create([
            'id' => Str::uuid()->toString(),
            ...$args,
        ]);
    }
}
