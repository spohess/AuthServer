<?php

declare(strict_types=1);

namespace App\Support\Interfaces\Services;

interface ServiceInterface
{
    public function execute(ExecutableInterface $executable);
}
