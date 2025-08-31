<?php

declare(strict_types=1);

namespace App\Support\Traits;

use Illuminate\Support\Arr;

trait EnumTools
{
    public static function values(): array
    {
        return Arr::pluck(self::cases(), 'value');
    }

    public static function except(array $except): array
    {
        $processedArray = Arr::map($except, fn($item) => $item instanceof self ? $item->value : $item);

        return array_diff(self::values(), $processedArray);
    }
}
