<?php

declare(strict_types=1);

namespace App\Support\Auth\Services;

use App\Base\Interfaces\Services\ExecutableInterface;
use App\Base\Interfaces\Services\ServiceInterface;

class AuthCodeRequestService implements ServiceInterface
{
    public function __construct() {}

    public function execute(ExecutableInterface $executable)
    {
        $data = $executable->handler();

        $authCode = $this->codeCreator->create([

        ]);
    }
}
