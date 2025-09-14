<?php

declare(strict_types=1);

namespace App\Support\Auth\Database\Factories;

use App\Base\Enums\ProfileNameEnum;
use App\Support\Auth\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'name' => fake()->unique()->randomElement(ProfileNameEnum::values()),
            'description' => fake()->optional()->sentence(),
        ];
    }
}
