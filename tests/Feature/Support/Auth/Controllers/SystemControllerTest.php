<?php

declare(strict_types=1);

use App\Support\Manager\Controllers\SystemController;
use App\Support\Manager\Models\System;
use App\Support\Manager\Models\User;
use App\Support\Manager\Requests\System\SystemIndexRequest;
use App\Support\Manager\Requests\System\SystemStoreRequest;
use App\Support\Manager\Requests\System\SystemUpdateRequest;
use App\Support\Manager\Resources\SystemResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

beforeEach(function () {
    $this->controller = app()->make(SystemController::class);
});

describe('Feature test for SystemController', function () {
    describe('index', function () {
        it('should get a collection resource with all systems', function () {
            System::factory(5)->create();

            $request = Mockery::mock(SystemIndexRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn([]);
            $resource = $this->controller->index($request);

            expect($resource)->toHaveCount(5)
                ->and($resource)->toBeInstanceOf(AnonymousResourceCollection::class);
        });

        it('should get a collection resource blocked systems', function () {
            System::factory(2)->create(['blocked_at' => now()]);
            System::factory(3)->create(['blocked_at' => null]);

            $request = Mockery::mock(SystemIndexRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn(['blocked_at' => true]);
            $resource = $this->controller->index($request);

            expect($resource)->toHaveCount(2);
        });

        it('should get a collection resource with one model filter by username', function () {
            $username = fake()->userName();
            System::factory(2)->create();
            System::factory()->create([
                'username' => $username,
            ]);

            $request = Mockery::mock(SystemIndexRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn(['username' => $username]);
            $resource = $this->controller->index($request);

            expect($resource)->toHaveCount(1);
        });

        it('should get a empty collection resource filter by invalid username', function () {
            System::factory(2)->create();

            $request = Mockery::mock(SystemIndexRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn(['username' => 'INVALID_INVALID']);
            $resource = $this->controller->index($request);

            expect($resource)->toHaveCount(0);
        });

        it('should get a collection resource with all systems by api', function () {
            $admin = User::factory()->create([
                'blocked_at' => null,
                'root' => true,
            ]);
            System::factory(5)->create();

            $response = $this->actingAs($admin)->getJson(route('manager.systems.index'))
                ->assertStatus(200)
                ->json();

            expect($response['data'])->toHaveCount(5);
        });

        it('should get error Unauthenticated by not root user', function () {
            $admin = User::factory()->create([
                'blocked_at' => null,
                'root' => false,
            ]);
            System::factory(5)->create();

            $response = $this->actingAs($admin)->getJson(route('manager.systems.index'))
                ->assertStatus(401)
                ->json();

            expect($response['message'])->toBe('Unauthenticated.');
        });
    });

    describe('store', function () {
        it('should create a user', function () {
            $data = System::factory()->make()->toArray();

            $request = Mockery::mock(SystemStoreRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn($data);
            $resource = $this->controller->store($request);

            expect($resource)->toBeInstanceOf(SystemResource::class)
                ->and(json_decode($resource->toJson(), true))->toHaveKeys([
                    'id',
                    'username',
                    'blocked_at',
                ]);
            $this->assertDatabaseHas(System::class, $data);
        });

        it('should create a system by api', function () {
            $admin = User::factory()->create([
                'blocked_at' => null,
                'root' => true,
            ]);

            $password = str_shuffle(fake()->numerify('####') . fake()->word() . strtoupper(fake()->word()) . '!@#$');
            $this->actingAs($admin)->postJson(route('manager.systems.store'), [
                'name' => fake()->word(),
                'url' => fake()->url(),
                'username' => fake()->userName(),
                'password' => $password,
                'password_confirmation' => $password,
                'root' => false,
            ])->assertStatus(201)->json();
        });
    });

    describe('show', function () {
        it('should get user resource when pass a user', function () {
            $user = System::factory()->create();

            $resource = $this->controller->show($user);

            expect($resource)->toBeInstanceOf(SystemResource::class)
                ->and(json_decode($resource->toJson(), true))->toHaveKeys([
                    'id',
                    'username',
                    'blocked_at',
                ]);
        });
    });

    describe('update', function () {
        it('should update user data', function () {
            $originalUsername = fake()->userName();
            $newUsername = fake()->userName();
            $user = System::factory()->create([
                'username' => $originalUsername,
            ]);

            $request = Mockery::mock(SystemUpdateRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn(['username' => $newUsername]);

            $resource = $this->controller->update($request, $user);

            expect($resource)->toBeInstanceOf(SystemResource::class)
                ->and(json_decode($resource->toJson(), true))->toHaveKeys([
                    'id',
                    'username',
                    'blocked_at',
                ]);
            $this->assertDatabaseHas(System::class, [
                'username' => $newUsername,
            ]);
        });

        it('should update system data by api', function () {
            $admin = User::factory()->create([
                'blocked_at' => null,
                'root' => true,
            ]);
            $system = System::factory()->create();

            $password = str_shuffle(fake()->numerify('####') . fake()->word() . strtoupper(fake()->word()) . '!@#$');
            $this->actingAs($admin)->putJson(route('manager.systems.update', ['system' => $system]), [
                'username' => fake()->userName(),
                'password' => $password,
                'password_confirmation' => $password,
                'root' => false,
            ])->assertOk()->json();
        });
    });

    describe('delete', function () {
        it('should block user without delete', function () {
            $user = System::factory()->create([
                'blocked_at' => null,
            ]);

            $this->controller->destroy($user);

            $this->assertDatabaseHas(System::class, [
                'username' => $user->username,
            ]);
            expect($user->refresh()->blocked_at)->not()->toBeNull();
        });
    });
});
