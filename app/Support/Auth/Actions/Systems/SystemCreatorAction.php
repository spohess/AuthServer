<?php

declare(strict_types=1);

namespace App\Support\Auth\Actions\Systems;

use App\Base\Interfaces\Actions\CreatorActionInterface;
use App\Support\Auth\Models\System;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SystemCreatorAction implements CreatorActionInterface
{
    public function create(array $args): ?Model
    {
        return System::create([
            'id' => Str::uuid()->toString(),
            ...$args,
            'password' => bcrypt(Arr::get($args, 'password')),
        ]);
    }
}
