<?php

declare(strict_types=1);

namespace App\Support\Auth\Models;

use App\Support\Auth\Database\Factories\SystemFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string|null $ip
 * @property Carbon|null $blocked_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class System extends Authenticatable
{
    /** @use HasFactory<SystemFactory> */
    use HasFactory;
    use HasApiTokens;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'username',
        'password',
        'ip',
        'blocked_at',
    ];

    protected $casts = [
        'password' => 'hashed',
        'blocked_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
    ];

    protected static function newFactory(): SystemFactory
    {
        return SystemFactory::new();
    }
}
