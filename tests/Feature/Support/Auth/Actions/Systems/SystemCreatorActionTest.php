<?php

declare(strict_types=1);

use App\Support\Auth\Actions\Systems\SystemCreatorAction;
use App\Support\Auth\Models\System;

beforeEach(function () {
    $this->creator = app()->make(SystemCreatorAction::class);
});

describe('Feature test for SystemCreatorAction', function () {
    it('should create with valid args', function () {
        $data = System::factory()->raw();
        $user = $this->creator->create([
            ...$data,
            'password' => fake()->password(),
        ]);

        expect($user)->toBeInstanceOf(System::class);
        $this->assertDatabaseCount(System::class, 1);
        $this->assertDatabaseHas(System::class, $data);
    });
});
