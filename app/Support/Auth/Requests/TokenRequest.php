<?php

declare(strict_types=1);

namespace App\Support\Auth\Requests;

use App\Support\Auth\Rules\AuthCodeRule;
use Illuminate\Foundation\Http\FormRequest;

class TokenRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'code' => ['required', new AuthCodeRule($this->input('email'))],
        ];
    }
}
