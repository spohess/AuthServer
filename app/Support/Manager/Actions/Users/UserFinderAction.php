<?php

declare(strict_types=1);

namespace App\Support\Manager\Actions\Users;

use App\Base\Interfaces\Actions\FinderActionInterface;
use App\Support\Manager\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserFinderAction implements FinderActionInterface
{
    public function __construct(
        private User $user,
    ) {}

    public function find(array $filters): ?Model
    {
        $query = $this->user->query();
        foreach ($filters as $key => $value) {
            $query->where($key, '=', $value);
        }

        return $query->first();
    }
}
