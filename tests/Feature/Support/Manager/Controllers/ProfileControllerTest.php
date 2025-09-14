<?php

declare(strict_types=1);

use App\Support\Manager\Controllers\ProfileController;
use App\Support\Auth\Models\Profile;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

describe('Feature test for ProfileController', function () {
    it('should list all profiles', function () {
        Profile::factory(3)->create();
        $controller = app()->make(ProfileController::class);

        $response = $controller->index();

        expect($response)->toHaveCount(3)
            ->and($response)->toBeInstanceOf(AnonymousResourceCollection::class);
    });
});
