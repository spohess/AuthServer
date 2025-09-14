<?php

declare(strict_types=1);

use App\Support\Auth\Actions\User\UserDeleterAction;
use App\Support\Auth\Models\User;

describe('Feature test for UserDeleterAction', function () {
    it('should block user adding date com blocked_at', function () {
        $user = User::factory()->create([
            'blocked_at' => null,
        ]);
        $deleter = app()->make(UserDeleterAction::class);

        $deleter->delete($user);

        $user->refresh();
        $this->assertDatabaseHas(User::class, [
            'id' => $user->id,
        ]);
        expect($user->blocked_at)->not->toBeNull();
    });
});
