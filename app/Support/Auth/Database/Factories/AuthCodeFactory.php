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
            //
        ];
    }
}
