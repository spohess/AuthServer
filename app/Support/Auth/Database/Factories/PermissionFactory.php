<?php

declare(strict_types=1);

namespace App\Support\Auth\Database\Factories;

use App\Support\Auth\Models\Permission;
use App\Support\Auth\Models\Profile;
use App\Support\Auth\Models\System;
use App\Support\Auth\Models\User;
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
            'id' => fake()->uuid(),
            'system_id' => System::factory(),
            'user_id' => User::factory(),
            'profile_id' => Profile::inRandomOrder()->first()->id,
            'select' => true,
            'insert' => fake()->boolean(),
            'update' => fake()->boolean(),
            'delete' => fake()->boolean(),
        ];
    }
}
