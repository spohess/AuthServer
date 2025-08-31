<?php

declare(strict_types=1);

namespace App\Base\Interfaces\Actions;

interface InserterActionInterface
{
    public function insert(array $args): bool;
}
