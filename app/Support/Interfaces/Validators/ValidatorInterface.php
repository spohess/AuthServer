<?php

declare(strict_types=1);

namespace App\Support\Interfaces\Validators;

use App\Support\Exceptions\ValidationException;

interface ValidatorInterface
{
    /**
     * @param mixed $subject
     *
     * @throws ValidationException
     */
    public function validate($subject): void;
}
