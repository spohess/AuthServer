<?php

declare(strict_types=1);

namespace App\Support\Auth\Actions\Permission;

use App\Base\Interfaces\Actions\UpdaterActionInterface;
use App\Support\Auth\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class PermissionUpdaterAction implements UpdaterActionInterface
{
    /**
     * @param Permission $model
     */
    public function update(Model $model, array $args): bool
    {
        return $model->update($args);
    }
}
