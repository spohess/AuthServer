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
            'id' => $this->faker->uuid(),
            'system_id' => System::factory(),
            'user_id' => User::factory(),
            'profile_id' => Profile::inRandomOrder()->first()->id,
            'select' => true,
            'insert' => $this->faker->boolean(),
            'update' => $this->faker->boolean(),
            'delete' => $this->faker->boolean(),
        ];
    }
}
