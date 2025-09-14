<?php

declare(strict_types=1);

namespace App\Support\Manager\Controllers;

use App\Base\Abstracts\Controller;
use App\Support\Auth\Actions\Permission\PermissionCollectorAction;
use App\Support\Auth\Actions\Permission\PermissionCreatorAction;
use App\Support\Auth\Actions\Permission\PermissionDeleterAction;
use App\Support\Auth\Actions\Permission\PermissionUpdaterAction;
use App\Support\Auth\Models\Permission;
use App\Support\Auth\Resources\PermissionResource;
use App\Support\Manager\Requests\Permission\PermissionIndexRequest;
use App\Support\Manager\Requests\Permission\PermissionStoreRequest;
use App\Support\Manager\Requests\Permission\PermissionUpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    public function __construct(
        private PermissionCollectorAction $collector,
        private PermissionCreatorAction $creator,
        private PermissionUpdaterAction $updater,
        private PermissionDeleterAction $deleter,
    ) {}

    public function index(PermissionIndexRequest $request): AnonymousResourceCollection
    {
        return PermissionResource::collection(
            $this->collector->collect($request->validated()),
        );
    }

    public function store(PermissionStoreRequest $request): PermissionResource
    {
        return new PermissionResource(
            $this->creator->create($request->validated()),
        );
    }

    public function show(Permission $permission): PermissionResource
    {
        return new PermissionResource($permission);
    }

    public function update(PermissionUpdateRequest $request, Permission $permission): PermissionResource
    {
        $this->updater->update($permission, $request->validated());

        return new PermissionResource($permission->refresh());
    }

    public function destroy(Permission $permission): Response
    {
        $this->deleter->delete($permission);

        return response()->noContent();
    }
}
