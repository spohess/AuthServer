<?php

namespace App\Support\Auth\Controllers;

use App\Base\Abstracts\Controller;
use App\Support\Auth\Models\Profile;
use App\Support\Auth\Resources\ProfileResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProfileController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ProfileResource::collection(Profile::all());
    }
}
