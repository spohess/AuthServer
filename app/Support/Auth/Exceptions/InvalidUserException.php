<?php

declare(strict_types=1);

namespace App\Support\Auth\Exceptions;

use App\Base\Exceptions\ValidationException;

class InvalidUserException extends ValidationException
{
    protected $code = 422;

    protected $message = 'Invalid user ou password';
}
