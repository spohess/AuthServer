<?php

declare(strict_types=1);

namespace App\Support\Auth\Controllers\Code;

use App\Base\Abstracts\Controller;
use App\Support\Auth\Actions\User\UserFinderAction;
use App\Support\Auth\Models\User;
use App\Support\Auth\Requests\TokenRequest;
use Illuminate\Http\JsonResponse;

class TokenController extends Controller
{
    public function __construct(
        private UserFinderAction $finder,
    ) {}

    public function __invoke(TokenRequest $request): JsonResponse
    {
        /**
         * @var User $user
         */
        $user = $this->finder->find([
            'email' => $request->input('email'),
        ]);
        $token = $user->createToken(config('app.name'));

        return response()->json([
            'token' => $token->plainTextToken,
        ], 201);
    }
}
