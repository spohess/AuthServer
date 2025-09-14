<?php

declare(strict_types=1);

namespace App\Support\Auth\Models;

use App\Support\Auth\Database\Factories\PermissionFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $system_id
 * @property string $user_id
 * @property string $profile_id
 * @property bool $select
 * @property bool $insert
 * @property bool $update
 * @property bool $delete
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property System $system
 * @property User $use
 * @property Profile $profile
 */
class Permission extends Model
{
    /** @use HasFactory<PermissionFactory> */
    use HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'system_id',
        'user_id',
        'profile_id',
        'select',
        'insert',
        'update',
        'delete',
    ];

    protected $casts = [
        'select' => 'boolean',
        'insert' => 'boolean',
        'update' => 'boolean',
        'delete' => 'boolean',
    ];

    protected static function newFactory(): PermissionFactory
    {
        return PermissionFactory::new();
    }

    public function system(): BelongsTo
    {
        return $this->belongsTo(System::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
