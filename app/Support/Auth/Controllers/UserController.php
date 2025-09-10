<?php

declare(strict_types=1);

namespace App\Support\Auth\Controllers;

use App\Base\Abstracts\Controller;
use App\Support\Auth\Actions\Users\UserCollectorAction;
use App\Support\Auth\Actions\Users\UserCreatorAction;
use App\Support\Auth\Actions\Users\UserDeleterAction;
use App\Support\Auth\Actions\Users\UserUpdaterAction;
use App\Support\Auth\Models\User;
use App\Support\Auth\Requests\UserIndexRequest;
use App\Support\Auth\Requests\UserStoreRequest;
use App\Support\Auth\Requests\UserUpdateRequest;
use App\Support\Auth\Resources\UserResource;
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
