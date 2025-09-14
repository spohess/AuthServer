<?php

declare(strict_types=1);

use App\Support\Auth\Models\Permission;
use App\Support\Auth\Models\Profile;
use App\Support\Auth\Models\System;
use App\Support\Auth\Models\User;
use App\Support\Auth\Resources\PermissionResource;
use App\Support\Manager\Controllers\PermissionController;
use App\Support\Manager\Requests\Permission\PermissionIndexRequest;
use App\Support\Manager\Requests\Permission\PermissionStoreRequest;
use App\Support\Manager\Requests\Permission\PermissionUpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

beforeEach(function () {
    $this->root = User::factory()->create([
        'root' => true,
    ]);
    $this->controller = app()->make(PermissionController::class);
    $this->profile = Profile::factory()->create();
});

describe('Feature test for PermissionController', function () {
    describe('index', function () {
        it('should get all permissions', function () {
            Permission::factory(5)->create([
                'profile_id' => $this->profile->id,
            ]);
            $request = Mockery::mock(PermissionIndexRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn([]);

            $resource = $this->controller->index($request);
            expect($resource)->toHaveCount(5)
                ->and($resource)->toBeInstanceOf(AnonymousResourceCollection::class);
        });

        it('should get some permissions by filter', function () {
            $system = System::factory()->create();
            Permission::factory(5)->create([
                'system_id' => $system->id,
                'profile_id' => $this->profile->id,
            ]);
            $systemOnFilter = System::factory()->create();
            Permission::factory(3)->create([
                'system_id' => $systemOnFilter->id,
                'profile_id' => $this->profile->id,
            ]);
            $request = Mockery::mock(PermissionIndexRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn(['system_id' => $systemOnFilter->id]);

            $resource = $this->controller->index($request);
            expect($resource)->toHaveCount(3)
                ->and($resource)->toBeInstanceOf(AnonymousResourceCollection::class);
        });

        it('should get some permissions by filter by api', function () {
            $system = System::factory()->create();
            Permission::factory(5)->create([
                'system_id' => $system->id,
                'profile_id' => $this->profile->id,
            ]);
            $systemOnFilter = System::factory()->create();
            Permission::factory(3)->create([
                'system_id' => $systemOnFilter->id,
                'profile_id' => $this->profile->id,
            ]);

            $response = $this->actingAs($this->root)->getJson(route('manager.permissions.index', [
                'system_id' => $systemOnFilter->id,
            ]));

            expect($response->json('data'))->toHaveCount(3);
        });
    });

    describe('store', function () {
        it('should create a permission', function () {
            $data = Permission::factory()->make()->toArray();
            $request = Mockery::mock(PermissionStoreRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn($data);
            $resource = $this->controller->store($request);
            expect($resource)->toBeInstanceOf(PermissionResource::class)
                ->and($resource->toArray($request))->toHaveKeys([
                    'id',
                    'system',
                    'profile',
                    'profile',
                    'select',
                    'insert',
                    'update',
                    'delete',
                    'created_at',
                ]);
        });

        it('should create a permission by api', function () {
            $data = Permission::factory()->make()->toArray();

            $response = $this->actingAs($this->root)->postJson(route('manager.permissions.store'), $data);
            expect($response->json('data'))->toHaveKeys([
                'id',
                'system',
                'profile',
                'profile',
                'select',
                'insert',
            ]);
        });
    });

    describe('show', function () {
        it('should get permission resource when pass a permission', function () {
            $permission = Permission::factory()->create();
            $resource = $this->controller->show($permission);
            expect($resource)->toBeInstanceOf(PermissionResource::class)
                ->and($resource->toArray(request()))->toHaveKeys([
                    'id',
                    'system',
                    'profile',
                    'profile',
                    'select',
                    'insert',
                    'update',
                ]);
        });

        it('should get permission resource when pass a permission by api', function () {
            $permission = Permission::factory()->create([
                'profile_id' => $this->profile->id,
            ]);
            $response = $this->actingAs($this->root)
                ->getJson(
                    route(
                        'manager.permissions.show',
                        ['permission' => $permission],
                    ),
                );
            expect($response->json('data'))->toHaveKeys([
                'id',
                'system',
                'profile',
                'profile',
                'select',
                'insert',
                'update',
            ]);
        });
    });

    describe('update', function () {
        it('should update permission data', function () {
            $permission = Permission::factory()->create([
                'update' => true,
            ]);
            $request = Mockery::mock(PermissionUpdateRequest::class);
            $request->shouldReceive('validated')
                ->once()
                ->andReturn([
                    'update' => false,
                ]);

            $resource = $this->controller->update($request, $permission);

            expect($resource)->toBeInstanceOf(PermissionResource::class);
            $this->assertDatabaseHas(Permission::class, [
                'id' => $permission->id,
                'update' => false,
            ]);
        });

        it('should update permission data by api', function () {
            $permission = Permission::factory()->create([
                'update' => true,
            ]);
            $response = $this->actingAs($this->root)
                ->putJson(
                    route(
                        'manager.permissions.update',
                        ['permission' => $permission],
                    ),
                    ['update' => false],
                );
            expect($response->json('data'))->toHaveKeys([
                'id',
                'system',
                'profile',
                'profile',
                'select',
                'insert',
                'update',
            ]);
            $this->assertDatabaseHas(Permission::class, [
                'id' => $permission->id,
                'update' => 0,
            ]);
        });
    });

    describe('destroy', function () {
        it('should delete permission', function () {
            $permission = Permission::factory()->create();
            $this->controller->destroy($permission);
            $this->assertDatabaseMissing(Permission::class, [
                'id' => $permission->id,
            ]);
        });

        it('should delete permission by api', function () {
            $permission = Permission::factory()->create();
            $this->actingAs($this->root)
                ->deleteJson(
                    route(
                        'manager.permissions.destroy',
                        ['permission' => $permission],
                    ),
                )->assertStatus(204);
        });
    });
});
