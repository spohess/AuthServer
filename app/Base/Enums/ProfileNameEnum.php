<?php

declare(strict_types=1);

namespace App\Base\Enums;

use App\Base\Traits\EnumTools;

enum ProfileNameEnum: string
{
    use EnumTools;

    case VIEWER = 'viewer';

    case EDITOR = 'editor';

    case MANAGER = 'manager';

    case ADMINISTRATOR = 'administrator';
}
