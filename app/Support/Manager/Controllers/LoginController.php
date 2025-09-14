<?php

declare(strict_types=1);

namespace App\Support\Manager\Controllers;

use App\Base\Abstracts\Controller;
use App\Support\Manager\Actions\User\UserFinderAction;
use App\Support\Manager\Exceptions\InvalidUserException;
use App\Support\Manager\Generators\UserTokenGenerator;
use App\Support\Manager\Models\User;
use App\Support\Manager\Requests\LoginRequest;
use App\Support\Manager\Validators\UserPasswordValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(
        private UserFinderAction $finder,
        private UserPasswordValidator $validator,
        private UserTokenGenerator $generator,
    ) {}

    public function __invoke(LoginRequest $request): JsonResponse
    {
        /**
         * @var User $user
         */
        $user = $this->finder->find([
            'email' => $request->input('email'),
        ]);
        try {
            $this->validator->validate([
                'user' => $user,
                'password' => $request->input('password'),
            ]);
        } catch (InvalidUserException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
        Auth::login($user);
        $token = $this->generator->generate(['user' => $user]);

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ], 201);
    }
}
