<?php

declare(strict_types=1);

namespace App\Support\Manager\Database\Factories;

use App\Support\Manager\Models\System;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<System>
 */
class SystemFactory extends Factory
{
    protected $model = System::class;

    protected static ?string $password;

    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'name' => fake()->unique()->name(),
            'url' => fake()->unique()->url(),
            'username' => fake()->unique()->userName(),
            'password' => static::$password ??= Hash::make('password'),
            'ip' => fake()->optional()->ipv4(),
            'blocked_at' => fake()->optional()->dateTime(),
        ];
    }
}
