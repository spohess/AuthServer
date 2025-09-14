<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Base\Enums\ProfileNameEnum;
use App\Support\Manager\Actions\Profile\ProfileCreatorAction;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    private array $descriptions = [
        ProfileNameEnum::CUSTOMER->value => 'End user of the system, with access to features and services intended for clients or consumers.',
        ProfileNameEnum::ANALYST->value => 'Responsible for analyzing data, processes, and requirements to support business decisions.',
        ProfileNameEnum::SUPERVISOR->value => 'Oversees daily operations and team performance, ensuring tasks are completed efficiently.',
        ProfileNameEnum::MANAGER->value => 'Manages teams and projects, sets goals, and coordinates resources to achieve organizational objectives.',
        ProfileNameEnum::DIRECTOR->value => 'Leads multiple departments or divisions, defines strategic direction, and ensures alignment with company goals.',
        ProfileNameEnum::ADMINISTRATOR->value => 'Has full administrative privileges, responsible for system configuration, user management, and overall platform maintenance.',
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
