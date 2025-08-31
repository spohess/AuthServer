<?php

declare(strict_types=1);

namespace App\Base\Exceptions;

use Exception;

class ValidationException extends Exception
{
    protected $code = 422;

    protected $message = 'Subject is a invalid object';
}
