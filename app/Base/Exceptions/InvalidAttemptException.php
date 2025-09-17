<?php

namespace App\Base\Exceptions;

use Exception;

class InvalidAttemptException extends Exception
{
    protected $code = 401;

    protected $message = 'Invalid attempt';
}
