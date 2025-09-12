<?php

declare(strict_types=1);

namespace App\Base\Traits;

use Illuminate\Support\Arr;

trait EnumTools
{
    public static function values(): array
    {
        return Arr::pluck(self::cases(), 'value');
    }
}
