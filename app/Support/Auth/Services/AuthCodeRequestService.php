<?php

declare(strict_types=1);

namespace App\Support\Auth\Services;

use App\Base\Exceptions\CodeGeneratorException;
use App\Base\Exceptions\InvalidAttemptException;
use App\Base\Interfaces\Services\ExecutableInterface;
use App\Base\Interfaces\Services\ServiceInterface;
use App\Domain\Auth\ValueObjects\AuthCode;
use App\Support\Auth\Actions\AuthCode\AuthCodeCreatorAction;
use App\Support\Auth\Actions\AuthCode\AuthCodeFinderAction;
use App\Support\Auth\Actions\AuthCode\AuthCodeUpdaterAction;
use App\Support\Auth\Jobs\SendAuthCodeJob;
use App\Support\Auth\Models\AuthCode as AuthCodeModel;
use App\Support\Auth\Models\User;
use Illuminate\Support\Arr;

class AuthCodeRequestService implements ServiceInterface
{
    public function __construct(
        private AuthCodeFinderAction $finderAction,
        private AuthCodeCreatorAction $authCodeCreator,
        private AuthCodeUpdaterAction $authCodeUpdater,
    ) {}

    /**
     * @throws InvalidAttemptException
     * @throws CodeGeneratorException
     */
    public function execute(ExecutableInterface $executable): void
    {
        $data = $executable->handler();
        $user = Arr::get($data, 'user');
        $authCode = $this->getAuthCodeModel($user);

        SendAuthCodeJob::dispatch($user, $authCode);
    }

    /**
     * @throws InvalidAttemptException
     * @throws CodeGeneratorException
     */
    private function getAuthCodeModel(User $user): AuthCodeModel
    {
        /** @var AuthCodeModel $authCodeModel */
        $authCodeModel = $this->finderAction->find([
            'user_id' => $user->id,
        ]);
        $authCode = new AuthCode(
            $user->id,
            $authCodeModel?->expires_at,
            $authCodeModel?->attempts,
        );

        if ($authCodeModel) {
            return $this->updateAuthCodeModel($authCodeModel, $authCode);
        }

        return $this->createAuthCodeModel($authCode);
    }

    private function updateAuthCodeModel(AuthCodeModel $authCodeModel, AuthCode $authCode): AuthCodeModel
    {
        $this->authCodeUpdater->update($authCodeModel, $authCode->toArray());

        return $authCodeModel->refresh();
    }

    private function createAuthCodeModel(AuthCode $authCode): AuthCodeModel
    {
        return $this->authCodeCreator->create($authCode->toArray());
    }
}
