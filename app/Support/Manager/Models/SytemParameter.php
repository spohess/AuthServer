<?php

namespace App\Support\Manager\Models;

use App\Support\Manager\Database\Factories\SytemParameterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SytemParameter extends Model
{
    /** @use HasFactory<SytemParameterFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'key',
        'value',
        'active',
    ];
}
