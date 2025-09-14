<?php

declare(strict_types=1);

namespace App\Support\Manager\Models;

use App\Base\Enums\ProfileNameEnum;
use App\Support\Manager\Database\Factories\ProfileFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @mixin Builder
 * @property string $id
 * @property ProfileNameEnum $name
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Profile extends Model
{
    /** @use HasFactory<ProfileFactory> */
    use HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    protected $casts = [
        'name' => ProfileNameEnum::class,
    ];

    protected static function newFactory(): ProfileFactory
    {
        return ProfileFactory::new();
    }
}
