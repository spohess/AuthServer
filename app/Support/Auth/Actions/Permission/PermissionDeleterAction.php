<?php

declare(strict_types=1);

namespace App\Support\Auth\Actions\Permission;

use App\Base\Interfaces\Actions\DeleterActionInterface;
use App\Support\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;

class PermissionDeleterAction implements DeleterActionInterface
{
    /**
     * @param User $model
     */
    public function delete(Model $model): bool
    {
        return $model->update([
            'blocked_at' => now(),
        ]);
    }
}
