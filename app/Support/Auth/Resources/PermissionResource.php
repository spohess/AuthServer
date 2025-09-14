<?php

declare(strict_types=1);

namespace App\Support\Auth\Resources;

use App\Support\Auth\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Permission
 */
class PermissionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'system' => $this->system->name,
            'user' => $this->user->email,
            'profile' => $this->profile->name,
            'select' => $this->select,
            'insert' => $this->insert,
            'update' => $this->update,
            'delete' => $this->delete,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
