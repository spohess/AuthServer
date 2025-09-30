<?php

namespace App\Support\Manager\Database\Factories;

use App\Support\Manager\Models\SystemParameter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SystemParameter>
 */
class SystemParameterFactory extends Factory
{
    protected $model = SystemParameter::class;

    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'key' => strtolower($this->faker->word()),
            'value' => strtolower($this->faker->word()),
            'active' => fake()->boolean(80),
        ];
    }
}
