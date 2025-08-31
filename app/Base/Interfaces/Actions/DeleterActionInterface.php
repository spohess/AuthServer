<?php

declare(strict_types=1);

namespace App\Base\Interfaces\Actions;

use Illuminate\Database\Eloquent\Model;

interface DeleterActionInterface
{
    public function delete(Model $model): bool;
}
