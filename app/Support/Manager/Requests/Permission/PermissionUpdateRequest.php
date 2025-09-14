<?php

declare(strict_types=1);

namespace App\Support\Manager\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PermissionUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'insert' => ['nullable', 'boolean'],
            'update' => ['nullable', 'boolean'],
            'delete' => ['nullable', 'boolean'],
        ];
    }
}
