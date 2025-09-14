<?php

declare(strict_types=1);

namespace App\Support\Manager\Models;

use App\Support\Manager\Database\Factories\PermissionFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 */
class Permission extends Model
{
    /** @use HasFactory<PermissionFactory> */
    use HasFactory;

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
}
