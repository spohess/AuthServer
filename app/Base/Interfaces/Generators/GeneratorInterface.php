<?php

declare(strict_types=1);

namespace App\Base\Interfaces\Generators;

interface GeneratorInterface
{
    public function generate(array $args);
}
