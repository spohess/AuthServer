<?php

declare(strict_types=1);

namespace App\Support\Interfaces\Actions;

use Illuminate\Database\Eloquent\Model;

interface FinderActionInterface
{
    public function find(array $filters): ?Model;
}
