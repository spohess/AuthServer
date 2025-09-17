<?php

declare(strict_types=1);

namespace App\Base\Exceptions;

use Exception;

class CodeGeneretorException extends Exception
{
    protected $code = 500;

    protected $message = 'Error generating code';
}
