<?php

namespace Database\Seeders;

use App\Support\Auth\Actions\Users\UserCreatorAction;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function __construct(
        private UserCreatorAction $creator,
    ) {}

    public function run(): void
    {
        $password = str_shuffle(fake()->numerify('####') . fake()->word() . strtoupper(fake()->word()) . '!@#$');
        $this->creator->create([
            'email' => 'root@authserver.local',
            'password' => $password,
            'root' => true,
        ]);

        $this->command->info('  Administrator email: root@authserver.local');
        $this->command->info('  Administrator password: ' . $password);
    }
}
