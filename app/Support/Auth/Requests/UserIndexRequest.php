<?php

declare(strict_types=1);

namespace App\Support\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['nullable', 'email'],
            'blocked_at' => ['nullable', 'bool'],
        ];
    }
}
