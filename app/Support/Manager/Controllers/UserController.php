<?php

declare(strict_types=1);

namespace App\Support\Manager\Controllers;

use App\Base\Abstracts\Controller;
use App\Support\Manager\Actions\Users\UserCollectorAction;
use App\Support\Manager\Actions\Users\UserCreatorAction;
use App\Support\Manager\Actions\Users\UserDeleterAction;
use App\Support\Manager\Actions\Users\UserUpdaterAction;
use App\Support\Manager\Models\User;
use App\Support\Manager\Requests\User\UserIndexRequest;
use App\Support\Manager\Requests\User\UserStoreRequest;
use App\Support\Manager\Requests\User\UserUpdateRequest;
use App\Support\Manager\Resources\UserResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(
        private UserCollectorAction $collector,
        private UserCreatorAction $creator,
        private UserUpdaterAction $updater,
        private UserDeleterAction $deleter,
    ) {}

    public function index(UserIndexRequest $request): AnonymousResourceCollection
    {
        return UserResource::collection(
            $this->collector->collect($request->validated()),
        );
    }

    public function store(UserStoreRequest $request): UserResource
    {
        return new UserResource(
            $this->creator->create($request->validated()),
        );
    }

    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user): UserResource
    {
        $this->updater->update($user, $request->validated());

        return new UserResource($user->fresh());
    }

    public function destroy(User $user): Response
    {
        $this->deleter->delete($user);

        return response()->noContent();
    }
}
