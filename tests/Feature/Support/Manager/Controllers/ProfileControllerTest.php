<?php

declare(strict_types=1);

use App\Support\Auth\Models\Profile;
use App\Support\Auth\Models\User;
use App\Support\Manager\Controllers\ProfileController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

describe('Feature test for ProfileController', function () {
    it('should list all profiles', function () {
        Profile::factory(3)->create();
        $controller = app()->make(ProfileController::class);

        $response = $controller->index();

        expect($response)->toHaveCount(3)
            ->and($response)->toBeInstanceOf(AnonymousResourceCollection::class);
    });

    it('should list all profiles by api', function () {
        Profile::factory(3)->create();
        $root = User::factory()->create(['root' => true]);

        $response = $this->actingAs($root)
            ->getJson(route('manager.profiles.index'));

        expect($response->json('data'))->toHaveCount(3);
    });
});
