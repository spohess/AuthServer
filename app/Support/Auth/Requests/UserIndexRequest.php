<?php

namespace App\Support\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'blocked_at' => ['nullable'],
        ];
    }
}
