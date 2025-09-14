<?php

declare(strict_types=1);

namespace App\Support\Manager\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PermissionStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'system_id' => ['required', 'exists:systems,id'],
            'user_id' => ['required', 'exists:users,id'],
            'profile_id' => ['required', 'exists:profiles,id'],
            'insert' => ['required', 'boolean'],
            'update' => ['required', 'boolean'],
            'delete' => ['required', 'boolean'],
        ];
    }
}
