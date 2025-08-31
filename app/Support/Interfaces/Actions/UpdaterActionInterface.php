<?php

declare(strict_types=1);

namespace App\Support\Interfaces\Actions;

use Illuminate\Database\Eloquent\Model;

interface UpdaterActionInterface
{
    public function update(Model $model, array $args): bool;
}
