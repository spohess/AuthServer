<?php

declare(strict_types=1);

namespace App\Support\Manager\Actions\Profiles;

use App\Base\Interfaces\Actions\CreatorActionInterface;
use App\Support\Manager\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProfileCreatorAction implements CreatorActionInterface
{
    public function create(array $args): ?Model
    {
        return Profile::create([
            'id' => Str::uuid()->toString(),
            ...$args,
        ]);
    }
}
