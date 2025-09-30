<?php

namespace App\Support\Manager\Models;

use App\Support\Manager\Database\Factories\SytemParameterFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $key
 * @property string $value
 * @property bool $active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class SytemParameter extends Model
{
    /** @use HasFactory<SytemParameterFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'key',
        'value',
        'active',
    ];

    protected static function newFactory(): SytemParameterFactory
    {
        return SytemParameterFactory::new();
    }
}
