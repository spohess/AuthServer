<?php

declare(strict_types=1);

namespace App\Support\Manager\Actions\System;

use App\Base\Interfaces\Actions\UpdaterActionInterface;
use App\Support\Manager\Models\User;
use Illuminate\Database\Eloquent\Model;

class SystemUpdaterAction implements UpdaterActionInterface
{
    /**
     * @param User $model
     */
    public function update(Model $model, array $args): bool
    {
        if (array_key_exists('password', $args)) {
            $args['password'] = bcrypt($args['password']);
        }

        return $model->update($args);
    }
}
