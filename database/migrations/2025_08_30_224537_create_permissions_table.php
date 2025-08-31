<?php

declare(strict_types=1);

use App\Support\Auth\Models\Profile;
use App\Support\Auth\Models\System;
use App\Support\Auth\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->comment('Table to store permissions');

            $table->timestamps();

            $table->uuid('id')
                ->primary()
                ->comment('Unique identifier for each permission');

            $table->foreignIdFor(System::class)
                ->constrained()
                ->comment('Foreign key referencing systems table');

            $table->foreignIdFor(User::class)
                ->constrained()
                ->comment('Foreign key referencing users table');

            $table->foreignIdFor(Profile::class)
                ->constrained()
                ->comment('Foreign key referencing profiles table');

            $table->boolean('select')
                ->default(true)
                ->comment('Indicates if the permission allows selecting data');

            $table->boolean('insert')
                ->default(false)
                ->comment('Indicates if the permission allows inserting data');

            $table->boolean('update')
                ->default(false)
                ->comment('Indicates if the permission allows updating data');

            $table->boolean('delete')
                ->default(false)
                ->comment('Indicates if the permission allows deleting data');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
