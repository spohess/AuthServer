<?php

declare(strict_types=1);

use App\Support\Auth\Actions\User\UserCollectorAction;
use App\Support\Auth\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->collector = app()->make(UserCollectorAction::class);
});

describe('Feature test for UserCollectorAction', function () {
    it('should return collection with 3 users blocked_at false', function () {
        User::factory(3)->create([
            'blocked_at' => null,
        ]);
        User::factory(4)->create([
            'blocked_at' => now(),
        ]);

        $users = $this->collector->collect(['blocked_at' => false]);

        expect($users)->toBeInstanceOf(Collection::class)
            ->and($users)->toHaveCount(3);
    });

    it('should return collection with 4 users blocked_at true', function () {
        User::factory(3)->create([
            'blocked_at' => null,
        ]);
        User::factory(4)->create([
            'blocked_at' => now(),
        ]);

        $users = $this->collector->collect(['blocked_at' => true]);

        expect($users)->toBeInstanceOf(Collection::class)
            ->and($users)->toHaveCount(4);
    });

    it('should return collection with 1 users by email', function () {
        $email = fake()->safeEmail();
        User::factory()->create([
            'email' => $email,
        ]);
        User::factory(4)->create();

        $users = $this->collector->collect(['email' => $email]);

        expect($users)->toBeInstanceOf(Collection::class)
            ->and($users)->toHaveCount(1);
    });
});
