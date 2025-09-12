<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->comment('Users table');

            $table->uuid('id')
                ->primary()
                ->comment('Unique identifier for each user');

            $table->timestamps();

            $table->dateTime('blocked_at')
                ->nullable()
                ->comment('Blocked at timestamp');

            $table->string('email')
                ->unique()
                ->comment('Email address');

            $table->string('password')
                ->comment('Password hash');

            $table->boolean('root')
                ->default(false)
                ->comment('Indicates if the user has root privileges');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
