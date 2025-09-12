<?php

declare(strict_types=1);

namespace App\Support\Auth\Resources;

use App\Support\Auth\Models\System;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin System
 */
class SystemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'url' => $this->url,
            'username' => $this->username,
            'ip' => $this->ip,
            'blocked_at' => $this->blocked_at?->toDateTimeString(),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
