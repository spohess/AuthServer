<?php

declare(strict_types=1);

namespace App\Support\Auth\Actions\Permission;

use App\Base\Interfaces\Actions\CreatorActionInterface;
use App\Support\Auth\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PermissionCreatorAction implements CreatorActionInterface
{
    public function create(array $args): ?Model
    {
        return Permission::create([
            'id' => Str::uuid()->toString(),
            'select' => true,
            ...$args,
        ]);
    }
}
