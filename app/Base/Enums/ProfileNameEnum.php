<?php

declare(strict_types=1);

namespace App\Base\Enums;

use App\Base\Traits\EnumTools;

enum ProfileNameEnum: string
{
    use EnumTools;

    case CUSTOMER = 'customer';

    case ANALYST = 'analyst';

    case SUPERVISOR = 'supervisor';

    case MANAGER = 'manager';

    case DIRECTOR = 'director';

    case ADMINISTRATOR = 'administrator';
}
