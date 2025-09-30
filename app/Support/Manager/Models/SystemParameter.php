<?php

namespace App\Support\Manager\Models;

use App\Support\Manager\Database\Factories\SystemParameterFactory;
use App\Support\Manager\Enums\SystemKeyEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property SystemKeyEnum $key
 * @property string $value
 * @property bool $active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class SystemParameter extends Model
{
    /** @use HasFactory<SystemParameterFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'key',
        'value',
        'active',
    ];

    protected $casts = [
        'key' => SystemKeyEnum::class,
        'active' => 'boolean',
    ];

    protected static function newFactory(): SystemParameterFactory
    {
        return SystemParameterFactory::new();
    }
}
