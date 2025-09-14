<?php

declare(strict_types=1);

use App\Support\Auth\Resources\UserResource;
use App\Support\Manager\Controllers\UserController;
use App\Support\Auth\Models\User;
use App\Support\Manager\Requests\User\UserIndexRequest;
use App\Support\Manager\Requests\User\UserStoreRequest;
use App\Support\Manager\Requests\User\UserUpdateRequest;
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

        it('should get a collection resource with all users by api', function () {
            $admin = User::factory()->create([
                'blocked_at' => null,
                'root' => true,
            ]);
            User::factory(5)->create();

            $response = $this->actingAs($admin)->getJson(route('manager.users.index'))
                ->assertStatus(200)
                ->json();

            expect($response['data'])->toHaveCount(6);
        });

        it('should get error Unauthenticated by not root user', function () {
            $admin = User::factory()->create([
                'blocked_at' => null,
                'root' => false,
            ]);
            User::factory(5)->create();

            $response = $this->actingAs($admin)->getJson(route('manager.users.index'))
                ->assertStatus(401)
                ->json();

            expect($response['message'])->toBe('Unauthenticated.');
        });
    });

    describe('store', function () {
        it('should create a user', function () {
            $data = User::factory()->make()->toArray();

            $request = Mockery::mock(UserStoreRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn($data);
            $resource = $this->controller->store($request);

            expect($resource)->toBeInstanceOf(UserResource::class)
                ->and(json_decode($resource->toJson(), true))->toHaveKeys([
                    'id',
                    'email',
                    'blocked_at',
                ]);
            $this->assertDatabaseHas(User::class, $data);
        });

        it('should create a user by api', function () {
            $admin = User::factory()->create([
                'blocked_at' => null,
                'root' => true,
            ]);

            $password = str_shuffle(fake()->numerify('####') . fake()->word() . strtoupper(fake()->word()) . '!@#$');
            $this->actingAs($admin)->postJson(route('manager.users.store'), [
                'email' => fake()->safeEmail(),
                'password' => $password,
                'password_confirmation' => $password,
                'root' => false,
            ])->assertStatus(201)->json();
        });
    });

    describe('show', function () {
        it('should get user resource when pass a user', function () {
            $user = User::factory()->create();

            $resource = $this->controller->show($user);

            expect($resource)->toBeInstanceOf(UserResource::class)
                ->and(json_decode($resource->toJson(), true))->toHaveKeys([
                    'id',
                    'email',
                    'blocked_at',
                ]);
        });
    });

    describe('update', function () {
        it('should update user data', function () {
            $originalEmail = fake()->safeEmail();
            $newEmail = fake()->safeEmail();
            $user = User::factory()->create([
                'email' => $originalEmail,
            ]);

            $request = Mockery::mock(UserUpdateRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn(['email' => $newEmail]);

            $resource = $this->controller->update($request, $user);

            expect($resource)->toBeInstanceOf(UserResource::class)
                ->and(json_decode($resource->toJson(), true))->toHaveKeys([
                    'id',
                    'email',
                    'blocked_at',
                ]);
            $this->assertDatabaseHas(User::class, [
                'email' => $newEmail,
            ]);
        });

        it('should update user data by api', function () {
            $admin = User::factory()->create([
                'blocked_at' => null,
                'root' => true,
            ]);
            $user = User::factory()->create();

            $password = str_shuffle(fake()->numerify('####') . fake()->word() . strtoupper(fake()->word()) . '!@#$');
            $this->actingAs($admin)->putJson(route('manager.users.update', ['user' => $user]), [
                'email' => fake()->safeEmail(),
                'password' => $password,
                'password_confirmation' => $password,
                'root' => false,
            ])->assertOk()->json();
        });
    });

    describe('delete', function () {
        it('should block user without delete', function () {
            $user = User::factory()->create([
                'blocked_at' => null,
            ]);

            $this->controller->destroy($user);

            $this->assertDatabaseHas(User::class, [
                'email' => $user->email,
            ]);
            expect($user->refresh()->blocked_at)->not()->toBeNull();
        });
    });
});
