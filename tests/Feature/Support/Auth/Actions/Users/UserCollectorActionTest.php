<?php

declare(strict_types=1);

use App\Support\Auth\Actions\Users\UserCollectorAction;
use App\Support\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->collector = app()->make(UserCollectorAction::class);
});

describe('Feature test for UserCollectorAction', function () {
    it('should ...', function () {
        User::factory(3)->create([
            'blocked_at' => null,
        ]);
        User::factory(3)->create([
            'blocked_at' => now(),
        ]);


    });
});
