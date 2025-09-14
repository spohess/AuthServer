<?php

declare(strict_types=1);

namespace App\Support\Manager\Controllers;

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
