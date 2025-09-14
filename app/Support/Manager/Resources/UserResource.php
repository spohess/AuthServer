<?php

declare(strict_types=1);

namespace App\Support\Manager\Resources;

use App\Support\Manager\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'blocked_at' => $this->blocked_at?->toDateTimeString(),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
