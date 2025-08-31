<?php

namespace App\Support\Auth\Controllers;

use App\Support\Auth\Actions\Users\UserCollectorAction;
use App\Support\Auth\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController
{
    public function __construct(
        private UserCollectorAction $collector,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(
            $this->collector->collect(),
        );
    }

    public function create()
    {
        //
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
