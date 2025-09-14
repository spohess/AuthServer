<?php

declare(strict_types=1);

namespace App\Support\Manager\Controllers;

use App\Base\Abstracts\Controller;
use App\Support\Manager\Actions\Systems\SystemCollectorAction;
use App\Support\Manager\Actions\Systems\SystemCreatorAction;
use App\Support\Manager\Actions\Systems\SystemDeleterAction;
use App\Support\Manager\Actions\Systems\SystemUpdaterAction;
use App\Support\Manager\Models\System;
use App\Support\Manager\Requests\System\SystemIndexRequest;
use App\Support\Manager\Requests\System\SystemStoreRequest;
use App\Support\Manager\Requests\System\SystemUpdateRequest;
use App\Support\Manager\Resources\SystemResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SystemController extends Controller
{
    public function __construct(
        private SystemCollectorAction $collector,
        private SystemCreatorAction $creator,
        private SystemUpdaterAction $updater,
        private SystemDeleterAction $deleter,
    ) {}

    public function index(SystemIndexRequest $request): AnonymousResourceCollection
    {
        return SystemResource::collection(
            $this->collector->collect($request->validated()),
        );
    }

    public function store(SystemStoreRequest $request): SystemResource
    {
        return new SystemResource(
            $this->creator->create($request->validated()),
        );
    }

    public function show(System $system): SystemResource
    {
        return new SystemResource($system);
    }

    public function update(SystemUpdateRequest $request, System $system): SystemResource
    {
        $this->updater->update($system, $request->validated());

        return new SystemResource($system->fresh());
    }

    public function destroy(System $system): Response
    {
        $this->deleter->delete($system);

        return response()->noContent();
    }
}
