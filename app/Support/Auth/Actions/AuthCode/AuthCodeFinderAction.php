<?php

declare(strict_types=1);

namespace App\Support\Auth\Actions\AuthCode;

use App\Base\Interfaces\Actions\FinderActionInterface;
use App\Support\Auth\Models\AuthCode;
use Illuminate\Database\Eloquent\Model;

class AuthCodeFinderAction implements FinderActionInterface
{
    public function __construct(
        private AuthCode $authCode,
    ) {}

    public function find(array $filters): ?Model
    {
        $query = $this->authCode->query();
        foreach ($filters as $key => $value) {
            $query->where($key, '=', $value);
        }

        return $query->first();
    }
}
