<?php

declare(strict_types=1);

namespace App\Support\Auth\Models;

use App\Support\Auth\Database\Factories\UserFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $id
 * @property string $email
 * @property string $password
 * @property bool $root
 * @property Carbon|null $blocked_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    use Notifiable;
    use HasApiTokens;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'email',
        'password',
        'root',
        'blocked_at',
    ];

    protected $casts = [
        'password' => 'hashed',
        'blocked_at' => 'datetime',
        'root' => 'bool',
    ];

    protected $hidden = [
        'password',
    ];

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
