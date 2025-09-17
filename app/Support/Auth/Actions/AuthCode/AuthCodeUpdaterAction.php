<?php

declare(strict_types=1);

namespace App\Support\Auth\Actions\AuthCode;

use App\Base\Interfaces\Actions\UpdaterActionInterface;
use Illuminate\Database\Eloquent\Model;

class AuthCodeUpdaterAction implements UpdaterActionInterface
{
    public function update(Model $model, array $args): bool
    {
        return $model->update($args);
    }
}
