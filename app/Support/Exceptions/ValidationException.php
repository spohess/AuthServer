<?php

declare(strict_types=1);

namespace App\Support\Exceptions;

use Exception;

class ValidationException extends Exception
{
    protected $code = 422;

    protected $message = 'Subject is a invalid object';
}
