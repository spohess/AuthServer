<?php

namespace Database\Seeders;

use App\Support\Manager\Enums\SystemKeyEnum;
use App\Support\Manager\Models\SystemParameter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SytemParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => Str::uuid(),
                'key' => SystemKeyEnum::AUTH_CODE,
                'value' => 'enable',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        SystemParameter::insert($data);
    }
}
