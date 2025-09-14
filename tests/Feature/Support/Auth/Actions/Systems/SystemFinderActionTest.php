<?php

declare(strict_types=1);

use App\Support\Manager\Actions\User\UserFinderAction;
use App\Support\Manager\Models\User;

beforeEach(function () {
    $this->finder = app()->make(UserFinderAction::class);
});

describe('Feature test for UserFinderAction', function () {
    it('should find a user by email', function () {
        $email = fake()->safeEmail();
        $user = User::factory()->create([
            'email' => $email,
        ]);

        $userFound = $this->finder->find(['email' => $email]);

        expect($userFound->id)->toBe($user->id);
    });

    it('should receive null when pass invalid email', function () {
        User::factory()->create();

        $userFound = $this->finder->find(['email' => 'invalid_invalid']);

        expect($userFound)->toBeNull();
    });
});
