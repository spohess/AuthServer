<?php

declare(strict_types=1);

use App\Support\Auth\Actions\System\SystemUpdaterAction;
use App\Support\Auth\Models\System;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->updater = app()->make(SystemUpdaterAction::class);
});

describe('Feature teste for SystemUpdaterAction', function () {
    it('should send a new username and update system', function () {
        $originalUsername = fake()->userName();
        $newUsername = fake()->userName();
        $system = System::factory()->create([
            'username' => $originalUsername,
        ]);

        $this->updater->update($system, [
            'username' => $newUsername,
        ]);

        expect($system->refresh()->username)->toBe($newUsername);
    });

    it('should update password', function () {
        $system = System::factory()->create([
            'password' => bcrypt('TEST'),
        ]);

        $this->updater->update($system, [
            'password' => 'password',
        ]);

        expect(Hash::check('password', $system->refresh()->password))
            ->toBeTrue();
    });
});
