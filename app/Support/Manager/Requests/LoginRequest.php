<?php

declare(strict_types=1);

namespace App\Support\Manager\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
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
