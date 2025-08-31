<?php

declare(strict_types=1);

namespace App\Support\Interfaces\Actions;

use Illuminate\Database\Eloquent\Model;

interface DeleterActionInterface
{
    public function delete(Model $model): bool;
}
