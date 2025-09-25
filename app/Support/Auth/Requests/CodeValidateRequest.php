<?php

declare(strict_types=1);

namespace App\Support\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeValidateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'code' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            ...parent::messages(),
            'email.exists' => 'Invalid user or password',
        ];
    }
}
