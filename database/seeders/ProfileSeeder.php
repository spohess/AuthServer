<?php

namespace Database\Seeders;

use App\Base\Enums\ProfileNameEnum;
use App\Support\Auth\Actions\ProfileCreatorAction;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    private array $descriptions = [
        ProfileNameEnum::VIEWER->value => 'Can only view data, without making any changes',
        ProfileNameEnum::EDITOR->value => 'Can create and update records, but cannot delete or manage users',
        ProfileNameEnum::MANAGER->value => 'Can create, update, and delete records, and manage certain resources',
        ProfileNameEnum::ADMINISTRATOR->value => 'Has full access to all features and settings without restrictions',
    ];

    public function __construct(
        private ProfileCreatorAction $creator,
    ) {}

    public function run(): void
    {
        foreach (ProfileNameEnum::values() as $name) {
            $this->creator->create([
                'name' => $name,
                'description' => $this->descriptions[$name],
            ]);
        }
    }
}
