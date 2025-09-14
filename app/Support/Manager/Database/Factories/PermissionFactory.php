<?php

declare(strict_types=1);

namespace App\Support\Manager\Database\Factories;

use App\Support\Manager\Models\Permission;
use App\Support\Manager\Models\Profile;
use App\Support\Manager\Models\System;
use App\Support\Manager\Models\User;
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
