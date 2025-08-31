<?php

declare(strict_types=1);

namespace App\Base\Interfaces\Actions;

use Illuminate\Database\Eloquent\Model;

interface CreatorActionInterface
{
    public function create(array $args): ?Model;
}
