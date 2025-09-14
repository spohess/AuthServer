<?php

declare(strict_types=1);

use App\Support\Auth\Actions\System\SystemCollectorAction;
use App\Support\Auth\Models\System;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->collector = app()->make(SystemCollectorAction::class);
});

describe('Feature test for SystemCollectorAction', function () {
    it('should return collection with 3 systems blocked_at false', function () {
        System::factory(3)->create([
            'blocked_at' => null,
        ]);
        System::factory(4)->create([
            'blocked_at' => now(),
        ]);

        $users = $this->collector->collect(['blocked_at' => false]);

        expect($users)->toBeInstanceOf(Collection::class)
            ->and($users)->toHaveCount(3);
    });

    it('should return collection with 4 systems blocked_at true', function () {
        System::factory(3)->create([
            'blocked_at' => null,
        ]);
        System::factory(4)->create([
            'blocked_at' => now(),
        ]);

        $users = $this->collector->collect(['blocked_at' => true]);

        expect($users)->toBeInstanceOf(Collection::class)
            ->and($users)->toHaveCount(4);
    });

    it('should return collection with 1 systems Collect name', function () {
        System::factory(3)->create();
        System::factory()->create([
            'name' => 'Collect',
        ]);

        $systems = $this->collector->collect(['name' => 'Collect']);

        expect($systems)->toBeInstanceOf(Collection::class)
            ->and($systems)->toHaveCount(1);
    });

    it('should return collection with 1 users by email', function () {
        $username = fake()->userName();
        System::factory()->create([
            'username' => $username,
        ]);
        System::factory(4)->create();

        $systems = $this->collector->collect(['username' => $username]);

        expect($systems)->toBeInstanceOf(Collection::class)
            ->and($systems)->toHaveCount(1);
    });
});
