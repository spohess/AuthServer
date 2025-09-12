<?php

declare(strict_types=1);

namespace App\Support\Auth\Controllers;

use App\Base\Abstracts\Controller;
use App\Support\Auth\Actions\Users\UserFinderAction;
use App\Support\Auth\Exceptions\InvalidUserException;
use App\Support\Auth\Generators\UserTokenGenerator;
use App\Support\Auth\Models\User;
use App\Support\Auth\Requests\LoginRequest;
use App\Support\Auth\Validators\UserPasswordValidator;
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
