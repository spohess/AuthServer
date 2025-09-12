<?php

declare(strict_types=1);

namespace App\Support\Auth\Requests\System;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SystemUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:32', 'unique:systems,name'],
            'url' => ['nullable', 'string', 'max:255', 'url'],
            'username' => ['nullable', 'string', 'max:32', 'unique:systems,username'],
            'password' => ['nullable', Password::min(12)->mixedCase()->numbers()->symbols(), 'confirmed'],
            //password_confirmation
            'ip' => ['nullable', 'string', 'max:45', 'ip'],
        ];
    }
}
