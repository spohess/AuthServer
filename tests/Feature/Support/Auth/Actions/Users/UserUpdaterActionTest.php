<?php

declare(strict_types=1);

use App\Support\Manager\Actions\Users\UserUpdaterAction;
use App\Support\Manager\Models\User;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->updater = app()->make(UserUpdaterAction::class);
});

describe('Feature teste for UserUpdaterAction', function () {
    it('should send a new email and update user', function () {
        $originalEmail = fake()->safeEmail();
        $newEmail = fake()->safeEmail();
        $user = User::factory()->create([
            'email' => $originalEmail,
        ]);

        $this->updater->update($user, [
            'email' => $newEmail,
        ]);

        expect($user->refresh()->email)->toBe($newEmail);
    });

    it('should update password', function () {
        $user = User::factory()->create([
            'password' => bcrypt('TEST'),
        ]);

        $this->updater->update($user, [
            'password' => 'password',
        ]);

        expect(Hash::check('password', $user->refresh()->password))
            ->toBeTrue();
    });
});
