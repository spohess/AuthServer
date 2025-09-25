<?php

declare(strict_types=1);

namespace App\Support\Auth\Controllers;

use App\Base\Abstracts\Controller;
use App\Base\Exceptions\InvalidAttemptException;
use App\Support\Auth\Actions\User\UserFinderAction;
use App\Support\Auth\Exceptions\InvalidUserException;
use App\Support\Auth\Executables\AuthCodeRequestExecutable;
use App\Support\Auth\Models\User;
use App\Support\Auth\Requests\CodeRequestRequest;
use App\Support\Auth\Services\AuthCodeRequestService;
use App\Support\Auth\Validators\UserPasswordValidator;
use Illuminate\Http\JsonResponse;
use Throwable;

class CodeRequestController extends Controller
{
    public function __construct(
        private UserFinderAction $finder,
        private UserPasswordValidator $validator,
        private AuthCodeRequestService $requestService,
    ) {}

    /**
     * @throws Throwable
     */
    public function __invoke(CodeRequestRequest $request): JsonResponse
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

        $executable = app()->make(AuthCodeRequestExecutable::class, [
            'user' => $user,
        ]);
        try {
            $this->requestService->execute($executable);
        } catch (InvalidAttemptException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode());
        }

        return response()->json([
            'message' => 'The code has been sent to your email.',
        ]);
    }
}
