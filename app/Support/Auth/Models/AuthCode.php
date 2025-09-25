<?php

declare(strict_types=1);

namespace App\Support\Auth\Models;

use App\Support\Auth\Database\Factories\AuthCodeFactory;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 * @property string $id
 * @property string $email
 * @property int $code
 * @property Carbon $expires_at
 * @property int $attempts
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class AuthCode extends Model
{
    /** @use HasFactory<AuthCodeFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'email',
        'code',
        'expires_at',
        'attempts',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    protected static function newFactory(): AuthCodeFactory
    {
        return new AuthCodeFactory();
    }
}
