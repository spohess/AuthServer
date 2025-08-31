<?php

declare(strict_types=1);

namespace App\Base\Interfaces\Transformers;

interface TransformerInterface
{
    public function transform(array $data): array;
}
