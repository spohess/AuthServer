<?php

declare(strict_types=1);

use App\Support\Manager\Actions\User\UserCreatorAction;
use App\Support\Manager\Models\User;

beforeEach(function () {
    $this->creator = app()->make(UserCreatorAction::class);
});

describe('Feature test for UserCreatorAction', function () {
    it('should create with valid args', function () {
        $data = [
            'email' => fake()->safeEmail(),
            'root' => false,
            'blocked_at' => null,
        ];

        $user = $this->creator->create([
            ...$data,
            'password' => fake()->password(),
        ]);

        expect($user)->toBeInstanceOf(User::class);
        $this->assertDatabaseCount(User::class, 1);
        $this->assertDatabaseHas(User::class, $data);
    });
});
