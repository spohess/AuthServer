<?php

declare(strict_types=1);

namespace App\Support\Auth\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class SystemIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable'],
            'username' => ['nullable'],
            'ip' => ['nullable'],
            'blocked_at' => ['nullable', 'bool'],
        ];
    }
}
