<?php

declare(strict_types=1);

namespace App\Support\Interfaces\Actions;

use Illuminate\Database\Eloquent\Collection;

interface CollectorActionInterface
{
    public function collect(?array $filters = null): ?Collection;
}
