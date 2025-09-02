<?php

declare(strict_types=1);

use App\Base\Enums\ProfileNameEnum;
use App\Support\Auth\Actions\Profiles\ProfileCreatorAction;
use App\Support\Auth\Models\Profile;

beforeEach(function () {
    $this->creator = app()->make(ProfileCreatorAction::class);
});

describe('Feature test for ProfileCreatorActio', function () {
    it('should create with valid args', function () {
        $data = [
            'name' => fake()->randomElement(ProfileNameEnum::values()),
            'description' => fake()->sentence(),
        ];

        $profile = $this->creator->create($data);

        expect($profile)->toBeInstanceOf(Profile::class);
        $this->assertDatabaseCount(Profile::class, 1);
        $this->assertDatabaseHas(Profile::class, $data);
    });
});
