<?php

declare(strict_types=1);

namespace App\Support\Auth\Controllers;

use App\Base\Abstracts\Controller;
use App\Support\Auth\Actions\Users\UserFinderAction;
use App\Support\Auth\Generators\UserTokenGenerator;
use App\Support\Auth\Requests\LoginRequest;
use App\Support\Auth\Validators\UserPasswordValidator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(
        private UserFinderAction $finder,
        private UserPasswordValidator $validator,
        private UserTokenGenerator $generator,
    ) {}

    public function __invoke(LoginRequest $request)
    {
        $user = $this->finder->find([
            'email' => $request->input('email'),
        ]);
        $this->validator->validate([
            'user' => $user,
            'password' => $request->input('password'),
        ]);
        Auth::login($user);
        $token = $this->generator->generate(['user' => $user]);

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ], 201);
    }
}
