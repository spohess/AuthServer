<?php

declare(strict_types=1);

use App\Base\Enums\ProfileNameEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->comment('Table to store user profiles');

            $table->timestamps();

            $table->uuid('id')
                ->unique()
                ->comment('Unique identifier for each profile');

            $table->enum('name', ProfileNameEnum::values())
                ->comment('Name of the profile');

            $table->text('description')
                ->nullable()
                ->comment('Description of the profile');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
