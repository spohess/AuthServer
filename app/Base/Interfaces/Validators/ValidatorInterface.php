<?php

declare(strict_types=1);

namespace App\Base\Interfaces\Validators;

use App\Base\Exceptions\ValidationException;

interface ValidatorInterface
{
    /**
     * @param mixed $subject
     *
     * @throws ValidationException
     */
    public function validate($subject): void;
}
