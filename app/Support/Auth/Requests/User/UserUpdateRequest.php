<?php

declare(strict_types=1);

namespace App\Support\Auth\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['nullable', 'email', 'unique:users,email'],
            'password' => ['nullable', Password::min(8)->mixedCase()->numbers(), 'confirmed'],
            //password_confirmation
        ];
    }
}
