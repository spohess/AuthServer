<?php

declare(strict_types=1);

use App\Support\Auth\Actions\Users\UserCollectorAction;
use App\Support\Auth\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->collector = app()->make(UserCollectorAction::class);
});

describe('Feature test for UserCollectorAction', function () {
    it('should return collection with 3 users blocked_at null', function () {
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

    it('should return collection with 4 users blocked_at not null', function () {
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
});
