<?php

declare(strict_types=1);

namespace App\Support\Auth\Database\Factories;

use App\Support\Auth\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Permission>
 */
class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition(): array
    {
        return [
            //
        ];
    }
}
