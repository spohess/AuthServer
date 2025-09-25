<?php

declare(strict_types=1);

namespace App\Support\Auth\Database\Factories;

use App\Support\Auth\Models\AuthCode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AuthCode>
 */
class AuthCodeFactory extends Factory
{
    protected $model = AuthCode::class;

    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'email' => fake()->unique()->safeEmail(),
            'code' => fake()->unique()->randomNumber(6),
            'expires_at' => fake()->dateTimeBetween('+1 hour', '+3 hour'),
            'attempts' => fake()->numberBetween(1, 5),
        ];
    }
}
