<?php

declare(strict_types=1);

namespace App\Support\Manager\Database\Factories;

use App\Support\Manager\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    protected static ?string $password;

    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'root' => fake()->boolean(10),
            'blocked_at' => fake()->optional()->dateTime(),
        ];
    }
}
