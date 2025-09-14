<?php

declare(strict_types=1);

namespace App\Support\Manager\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PermissionIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'system_id' => ['nullable', 'exists:systems,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'profile_id' => ['nullable', 'exists:profiles,id'],
        ];
    }
}
