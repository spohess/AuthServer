<?php

declare(strict_types=1);

use App\Support\Auth\Controllers\UserController;
use App\Support\Auth\Models\User;
use App\Support\Auth\Requests\UserIndexRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

beforeEach(function () {
    $this->controller = app()->make(UserController::class);
});

describe('Feature test for UserController', function () {
    describe('index', function () {
        it('should get a collection resource with all users', function () {
            User::factory(5)->create();

            $request = Mockery::mock(UserIndexRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn([]);
            $resource = $this->controller->index($request);

            expect($resource)->toHaveCount(5)
                ->and($resource)->toBeInstanceOf(AnonymousResourceCollection::class);
        });

        it('should get a collection resource blocked users', function () {
            User::factory(2)->create(['blocked_at' => now()]);
            User::factory(3)->create(['blocked_at' => null]);

            $request = Mockery::mock(UserIndexRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn(['blocked_at' => true]);
            $resource = $this->controller->index($request);

            expect($resource)->toHaveCount(2);
        });

        it('should get a collection resource with one model filter by email', function () {
            $email = fake()->safeEmail();
            User::factory(2)->create();
            User::factory()->create([
                'email' => $email,
            ]);

            $request = Mockery::mock(UserIndexRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn(['email' => $email]);
            $resource = $this->controller->index($request);

            expect($resource)->toHaveCount(1);
        });

        it('should get a empty collection resource filter by invalid email', function () {
            User::factory(2)->create();

            $request = Mockery::mock(UserIndexRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn(['email' => 'INVALID_INVALID']);
            $resource = $this->controller->index($request);

            expect($resource)->toHaveCount(0);
        });
    });
});
