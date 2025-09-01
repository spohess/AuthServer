<?php

namespace App\Support\Auth\Controllers;

use App\Http\Requests\UserCreatorRequest;
use App\Http\Requests\UserIndexRequest;
use App\Support\Auth\Actions\Users\UserCollectorAction;
use App\Support\Auth\Actions\Users\UserCreatorAction;
use App\Support\Auth\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController
{
    public function __construct(
        private UserCollectorAction $collector,
        private UserCreatorAction $creator,
    ) {}

    public function index(UserIndexRequest $request): AnonymousResourceCollection
    {
        return UserResource::collection(
            $this->collector->collect($request->validated()),
        );
    }

    public function create(UserCreatorRequest $request)
    {
        return new UserResource(
            $this->creator->create($request->validated()),
        );
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
