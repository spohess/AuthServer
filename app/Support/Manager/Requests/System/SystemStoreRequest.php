<?php

declare(strict_types=1);

namespace App\Support\Manager\Requests\System;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SystemStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:32', 'unique:systems,name'],
            'url' => ['required', 'string', 'max:255', 'url'],
            'username' => ['required', 'string', 'max:32', 'unique:systems,username'],
            'password' => ['required', Password::min(12)->mixedCase()->numbers()->symbols(), 'confirmed'],
            //password_confirmation
            'ip' => ['nullable', 'string', 'max:45', 'ip'],
        ];
    }
}
